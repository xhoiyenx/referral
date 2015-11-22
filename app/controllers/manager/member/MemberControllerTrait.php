<?php
namespace App\Controllers\Manager\Member;
use App\Models\User;
use App\Models\Solution;

trait MemberControllerTrait
{
  public function solution_checkbox( User $user = null )
  {
    $selected = [];
    if ( $user != null ) {
      if ( isset( $user->meta['solutions'] ) )
        $selected = unserialize( $user->meta['solutions'] );
    }

    $solutions = Solution::all();
    $html = '';
    foreach ( $solutions as $solution )
    {
      $html .= '<div class="checkbox">';
      $html .= form()->checkbox('meta[solutions][]', $solution->id, in_array($solution->id, $selected), ['id' => 'cb_' . $solution->id]);
      $html .= form()->label('cb_' . $solution->id, $solution->name);
      $html .= '</div>';
    }
    return $html;
  }

  public function ajaxlist()
  {
  	# COMPLEX CODE FOR AJAX TABLE
    $field_names = [
      'user.fullname',
      'user.usermail',
      'total_lead',
      'total_fee',
      'logged_at'
    ];

    # init query object
    $query = User::query();
    $query->select(db()->raw('COUNT(lead.id) AS total_lead, SUM(user_meta.value) AS total_fee, user.*'));
    $query->join('user AS lead', 'lead.parent', '=', 'user.id');
    $query->join('user_meta', function($join) {
      $join->on('lead.id', '=', 'user_meta.user_id');
      $join->where('user_meta.attr', '=', 'total_fee');
    });
    $query->where('user.role_id', 2);
    $query->groupBy('user.id');

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

    # get data
    $rows = $query->get();

    # get total
    $total = count($rows);

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
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-light action dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i></button>
      <ul class="dropdown-menu dropdown-menu-list">
        <li><a class="action-edit" href="<?php echo route('client.lead.update', ['id' => $row->id]) ?>"><i class="fa falist fa-edit"></i>Edit</a></li>
        <li><a class="action-delete" href="#" data-id="<?php echo $row->id?>" data-name="<?php echo $row->first_name?>"><i class="fa falist fa-trash"></i>Delete</a></li>
      </ul>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }
}