<?php
namespace App\Controllers\Client\Lead;

trait LeadControllerTrait
{
  public function ajaxlist( $member_id = null )
  {
    # COMPLEX CODE FOR AJAX TABLE
    $field_names = [
      'created_at',
      'company',
      'fullname',
      'solutions',
      'referral_fee',
      'sales_id',
      'status'
    ];

    # because we have relationship table, need to create 2 query for filtering and ordering with sub data from another table
    # init query object
    $query = $this->lead->query();

    if ( ! is_null( $member_id ) )
      $query->where('leads.member_id', $member_id);

    if ( request()->has('status') ) {
      $status = request()->get('status');
      if ( $status != '' )
        $query->where('leads.status', $status);
    }

    if ( request()->has('ds') AND request()->has('de') ) {
      $date_start = request()->get('ds');
      $date_end   = request()->get('de');
      if ( $date_start != '' AND $date_end != '' ) {
        $query->whereBetween('leads.created_at', [$date_start, $date_end]);
      }
    }

    $search = request()->get('search');
    if ( $search['value'] != '' ) {
      $search = request()->get('search');
      $query->where('leads.company', 'like', '%' . $search['value'] . '%');
      $query->orWhere('leads.fullname', 'like', '%' . $search['value'] . '%');
    }

    # get total
    $total = $query->count();

    $query->select( db()->raw('leads.*, SUM( solutions.fee ) AS referral_fee, GROUP_CONCAT(solutions.name SEPARATOR ", ") AS solutions') );

    $query->leftJoin('lead_solutions', function($join) {
      $join->on('lead_solutions.lead_id', '=', 'leads.id');
    });

    $query->leftJoin('solutions', function($join) {
      $join->on('solutions.id', '=', 'lead_solutions.solution_id');
    });

    $query->groupBy('leads.id');

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

    # add offset
    $query->offset( $_POST['start'] );

    # add limit
    $query->take( $_POST['length'] );

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
    <a class="action-edit btn-sm btn-light btn-icon" title="Edit" href="<?php echo route('client.lead.update', ['id' => $row->id]) ?>"><i class="fa fa-edit"></i></a>
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