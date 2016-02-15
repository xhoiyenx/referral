<?php
namespace App\Repositories;
use App\Models\Lead;
use App\Models\LeadHistory;
use App\Models\Sales;

class LeadRepository
{
  protected $model;

  public function __construct(Lead $lead)
  {
    $this->model = $lead;
  }

  public function all()
  {
    return $this->model->all();
  }

  public function find( $value )
  {
    return $this->model->find( $value );
  }

  public function query()
  {
    return $this->model->query();
  }

  public function validate( $input, $id = null )
  {
    return Lead::validate( $input, $id );
  }

  public function statuses()
  {
    return [
      1 => 'Cold Lead',
      2 => 'Deal Closed',
      3 => 'Hot Lead',
      4 => 'Payment Received',
      5 => 'Warm Lead',
    ];
  }

  /**
   * Translate status
   * @param  string $status Status id
   * @return string Status name
   */
  public function getStatus( $status )
  {
    switch ( $status ) {
      case '1':
        return 'Cold Lead';
        break;
      
      case '2':
        return 'Deal Closed';
        break;
      
      case '3':
        return 'Hot Lead';
        break;
      
      case '4':
        return 'Payment Received';
        break;
      
      case '5':
        return 'Warm Lead';
        break;
    }
  }

  /**
   * Save lead, perform insert and update
   * @param  array $input [post data]
   * @param  Lead|null $lead  [existing lead for updating]
   * @return Lead
   */
  public function save( $input, Lead $lead = null )
  {
    if ( is_null($lead) ) {
      $lead = new $this->model;
      $lead->member_id  = auth()->member()->get()->id;
    }

    $lead->company      = $input['company'];
    $lead->fullname     = $input['fullname'];
    $lead->usermail     = $input['usermail'];
    $lead->phone        = $input['phone'];
    $lead->designation  = $input['designation'];
    $lead->introduce    = $input['introduce'];
    $lead->status       = isset($input['status']) ? $input['status'] : $lead->status;
    $lead->sales_id     = isset($input['sales_id']) ? $input['sales_id'] : null;

    if ( $lead->save() )
    {
      # INSERT PIVOT DATA
      if ( isset($input['solutions']) && !empty($input['solutions']) ) {
        $lead->solutions()->sync( $input['solutions'] );
      }
    }

    return $lead;
  }

  public function save_status( $input, Lead $lead = null )
  {
    if ( is_null($lead) )
      return false;

    if ( isset($input['solutions']) AND !empty($input['solutions']) ) {
      $lead->solutions()->sync( $input['solutions'] );
    }

    if ( isset($input['sales_id']) AND !empty($input['sales_id']) ) {
      if ( $lead->sales_id != $input['sales_id'] ) {
        $sales = Sales::find( $input['sales_id'] );
        app('events')->fire('lead.assign_sales', [$lead, $sales]);
      }
      $lead->sales_id = $input['sales_id'];
      $lead->save();
    }

    if ( $input['status'] != $lead->status ) {
      $lead->status = $input['status'];
      if ( $lead->save() ) {
        app('events')->fire('member.lead.status_update', [$lead]);
        return $lead;
      }
    }
    else {
      return $lead;
    }
  }

  public function save_history( $input, Lead $lead = null )
  {
    $is_admin = $is_sales = $is_member = false;
    if ( is_null($lead) )
      return false;

    $lead_history = new LeadHistory;
    $lead_history->lead_id = $lead->id;

    if ( isset( $input['is_admin'] ) ) {
      $lead_history->admin_id = $input['is_admin'];
    }

    if ( isset( $input['is_sales'] ) ) {
      $lead_history->sales_id = $input['is_sales'];
    }

    if ( isset( $input['is_member'] ) ) {
      $lead_history->member_id = $input['is_member'];
    }

    # check if status changed
    if ( $input['status'] != $lead->status ) {
      $lead_history->old_status = $lead->status;
      $lead_history->new_status = $input['status'];
      $lead->status = $input['status'];
    }

    # check if sales assigned
    if ( isset($input['sales_id']) AND !empty($input['sales_id']) ) {
      if ( $lead->sales_id != $input['sales_id'] ) {
        $lead_history->old_sales_id = $lead->sales_id;
        $lead_history->new_sales_id = $input['sales_id'];
        $lead->sales_id = $input['sales_id'];
      }      
    }

    # check if there any notes
    if ( ! empty( $input['notes'] ) ) {
      $lead_history->notes = $input['notes'];
    }

    # if no new status update and no notes, don't save and throw error
    if ( is_null($lead_history->new_sales_id) && is_null($lead_history->new_status) && is_null($lead_history->notes) ) {
      return redirect()->back()->withErrors('Please insert notes, assign sales or change lead status to save history')->send();
    }
    else {
      $lead->save();
      $lead_history->save();

      if ( ! is_null($lead_history->new_sales_id) ) {
        $sales = Sales::find( $lead_history->new_sales_id );
        app('events')->fire('lead.assign_sales', [$lead, $sales, $lead_history->notes]);
      }

      if ( ! is_null($lead_history->new_status) ) {
        app('events')->fire('member.lead.status_update', [$lead, $lead_history->notes]);
      }

      return $lead_history;
    }

  }

  public function leadCheck( $company_name )
  {
    $query = $this->query();
    $query->where('member_id', auth()->member()->get()->id);
    $query->where('company', $company_name);
    $query->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)');

    if ( $query->count() > 0 ) {
      return true;
    }
    else {
      return false;
    }

  }  
}