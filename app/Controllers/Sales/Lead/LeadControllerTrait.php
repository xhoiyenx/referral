<?php
namespace App\Controllers\Sales\Lead;
use App\Models\Lead;
use App\Models\Solution;

trait LeadControllerTrait
{
  public function ajaxlist( $member_id = null, $sales_id = null )
  {
    # COMPLEX CODE FOR AJAX TABLE
    $field_names = [
      'created_at',
      'company',
      'fullname',
      'solution',
      'referral_fee',
      'member',
      'sales',
      'status'
    ];

    # because we have relationship table, need to create 2 query for filtering and ordering with sub data from another table
    # init query object
    $query = $this->lead->query();

    if ( ! is_null( $member_id ) ) {
      $query->where('leads.member_id', $member_id);
      unset($field_names[5]);
      $field_names = array_values($field_names);
    }

    if ( ! is_null( $sales_id ) )
      $query->where('leads.sales_id', $sales_id);

    if ( request()->has('status') ) {
      $status = request()->get('status');
      if ( $status != '' )
        $query->where('leads.status', $status);
    }

    if ( request()->has('member_id') ) {
      $member_id = request()->get('member_id');
      if ( $member_id != '' )
        $query->where('leads.member_id', $member_id);
    }

    if ( request()->has('ds') AND request()->has('de') ) {
      $date_start = request()->get('ds');
      $date_end   = request()->get('de');
      if ( $date_start != '' AND $date_end != '' ) {
        $query->whereBetween(db()->raw('DATE(`leads`.`created_at`)'), [$date_start, $date_end]);
      }
    }

    $search = request()->get('search');
    if ( $search['value'] != '' ) {
      $search = request()->get('search');
      $query->where('leads.company', 'like', '%' . $search['value'] . '%');
      $query->orWhere('leads.fullname', 'like', '%' . $search['value'] . '%');
    }

    #$query->select( db()->raw('leads.*, members.id as members_id, members.fullname as members_name, lead_solutions.solution_id, CONCAT( sales.fullname, " (", sales.mobile, ")" ) AS sales, SUM( solutions.fee ) AS referral_fee, GROUP_CONCAT(solutions.name SEPARATOR ", ") AS solution') );
    $query->select( db()->raw('leads.*, members.id as members_id, members.fullname as members_name, lead_solutions.solution_id, CONCAT( sales.fullname, " (", sales.mobile, ")" ) AS sales, ( CASE WHEN ( SUM( lead_solutions.custom_fee ) > 0 ) THEN SUM( lead_solutions.custom_fee ) ELSE SUM( solutions.fee ) END ) AS referral_fee, GROUP_CONCAT(solutions.name SEPARATOR ", ") AS solution') );

    $query->leftJoin('sales', function($join) {
      $join->on('leads.sales_id', '=', 'sales.id');
    });

    $query->join('members', function($join) {
      $join->on('leads.member_id', '=', 'members.id');
    });

    $query->leftJoin('lead_solutions', function($join) {
      $join->on('lead_solutions.lead_id', '=', 'leads.id');
    });

    $query->leftJoin('solutions', function($join) {
      $join->on('solutions.id', '=', 'lead_solutions.solution_id');
    });

    $query->groupBy('leads.id');

    if ( request()->has('solution_id') ) {
      $solution = request()->get('solution_id');
      if ( $solution != '' )
        $query->where('lead_solutions.solution_id', '=', $solution);
    }

    # get total
    $total = count($query->get());    

    # setup ordering
    if ( isset( $_POST['order'] ) )
    {
      # TO-DO: add this code as library
      # this is works only for single ordering
      
      $field_key  = $_POST['order'][0]['column'];
      $field_ord  = $_POST['order'][0]['dir'];
      $field_name = $field_names[ $field_key ];
      $query->orderBy( $field_name, $field_ord );
    }

    # add limit
    if ( $_POST['length'] != -1 ) {
      # add offset
      $query->offset( $_POST['start'] );
      $query->take( $_POST['length'] );
    }

    $rows  = $query->get();

    $data  = [
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
      'data' => []
    ];

    if ( ! $rows->isEmpty() )
    {
      foreach ( $rows as $row )
      {
        # TO-DO add this to library
        # create flexibility on assigning data
        $fields = [];
        for ( $i = 0, $c = count($field_names); $i < $c; $i++ )
        {

          # CREATED AT
          if ( $field_names[$i] == 'created_at' ) {
            $fields[] = $row->created_at->toFormattedDateString();
            continue;
          }

          # STATUS
          if ( $field_names[$i] == 'status' ) {
            $fields[] = $this->lead->getStatus( $row->$field_names[$i] );
            continue;
          }

          # STATUS
          if ( $field_names[$i] == 'member' ) {
            $fields[] = '<a target="_blank" href="' . route('admin.member.profile', ['id' => $row->members_id]) . '">'. $row->members_name .'</a>';
            continue;
          }

          $fields[] = $row->$field_names[$i];

        }
        # Add action button here, on last column
        $fields[] = $this->list_action_button( $row );

        $data['data'][] = $fields;
      }
    }
    return json_encode($data);
  }

  protected function list_action_button( $row )
  {
    ob_start();
    ?>
    <a class="action-view btn-sm btn-light btn-icon" title="View" href="<?php echo route('sales.lead.profile', ['id' => $row->id]) ?>"><i class="fa fa-eye"></i></a>
    <!--
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-light action dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i></button>
      <ul class="dropdown-menu dropdown-menu-list">
        <li><a class="action-edit" href="<?php echo route('client.lead.update', ['id' => $row->id]) ?>"><i class="fa falist fa-edit"></i>Edit</a></li>
      </ul>
    </div>
    -->
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }
}