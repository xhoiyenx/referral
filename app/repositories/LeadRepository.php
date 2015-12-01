<?php
namespace App\Repositories;
use App\Models\Lead;

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

  public function validate( $input )
  {
    return Lead::validate( $input );
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
    $lead->mobile       = $input['mobile'];
    $lead->phone        = $input['phone'];
    $lead->designation  = $input['designation'];
    $lead->introduce    = $input['introduce'];
    $lead->status       = isset($input['status']) ? $input['status'] : $lead->status;
    $lead->sales_id     = isset($input['sales_id']) ? $input['sales_id'] : null;

    if ( $lead->save() )
    {
      # INSERT PIVOT DATA
      $lead->solutions()->sync( $input['solutions'] );
    }

    return $lead;
  }

  public function save_status( $input, Lead $lead )
  {
    if ( is_null($lead) )
      return false;

    if ( isset($input['solutions']) AND !empty($input['solutions']) ) {
      $lead->solutions()->sync( $input['solutions'] );
    }

    if ( $input['status'] != $lead->status ) {
      $lead->status = $input['status'];
      if ( $lead->save() ) {
        app('events')->fire('member.lead.status_update', [$lead]);
        return $lead;
      }
      $lead->save();
    }
    else {
      return $lead;
    }
  }
}