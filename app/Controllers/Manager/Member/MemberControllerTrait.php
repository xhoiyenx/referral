<?php
namespace App\Controllers\Manager\Member;
use App\Models\Member;
use App\Models\Solution;

trait MemberControllerTrait
{
  public function ajaxlist()
  {
  	# COMPLEX CODE FOR AJAX TABLE
    $field_names = [
      'created_at',
      'fullname',
      'usermail',
      'total_lead',
      'total_fee',
      'closed_deals',
      'logged_at'
    ];

    # init query object
    $query = $this->member->query();

    $query->leftJoin('leads', function($join) {
      $join->on('leads.member_id', '=', 'members.id');
    });

    $query->groupBy('members.id');

    $search = request()->get('search');
    if ( $search['value'] != '' ) {
      $search = request()->get('search');
      $query->where('members.fullname', 'like', '%' . $search['value'] . '%');
      $query->orWhere('members.usermail', 'like', '%' . $search['value'] . '%');
    }

    if ( request()->has('status') ) {
      $status = request()->get('status');
      if ( $status != '' )
        $query->where('members.status', $status);
    }    
    
    # get total
    $total  = count( $query->select(db()->raw(1))->get() );

    $query->leftJoin('lead_solutions', function($join) {
      $join->on('lead_solutions.lead_id', '=', 'leads.id');
    });

    $query->leftJoin('solutions', function($join) {
      $join->on('solutions.id', '=', 'lead_solutions.solution_id');
    });

    $query->select( db()->raw('members.created_at as created_at, members.id AS id, members.fullname AS fullname, members.usermail AS usermail, members.created_at AS logged_at, COUNT( DISTINCT leads.id ) AS total_lead, COUNT( DISTINCT CASE WHEN leads.status = 2 THEN leads.status ELSE NULL END ) as closed_deals, SUM( solutions.fee ) AS total_fee') );

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

    # get data
    $rows   = $query->get();

    $data  = [
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
      'data' => []
    ];

    if ( ! $rows->isEmpty() ) {
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

          $field = str_replace('user.', '', $field_names[$i]);
          $fields[] = $row->$field;
        }
        # Add action button here, on last column
        $fields[] = $this->list_action_button($row);

        $data['data'][] = $fields;
      }
    }
    return json_encode($data);
  }

  protected function list_action_button( $row )
  {
    ob_start();
    ?>
    <a class="action-edit btn-sm btn-light btn-icon" title="Edit" href="<?php echo route('admin.member.update', ['id' => $row->id]) ?>"><i class="fa fa-edit"></i></a>
    <a class="action-view btn-sm btn-light btn-icon" title="Edit" href="<?php echo route('admin.member.profile', ['id' => $row->id]) ?>"><i class="fa fa-eye"></i></a>
    <a class="btn-sm btn-light btn-icon" title="Send activation email" href="<?php echo route('admin.member.sendactivationemail', ['id' => $row->id]) ?>"><i class="fa fa-envelope"></i></a>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }
}