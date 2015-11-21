<?php
namespace App\Controllers\Client\Lead;
use App\Models\User;
use App\Models\Solution;

trait LeadControllerTrait
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
      'created_at',
      'usermeta.company',
      'fullname',
      'usermeta.solutions'
    ];

    # because we have relationship table, need to create 2 query for filtering and ordering with sub data from another table
    # init query object
    $query = User::query();
    $query->select( 'user.id' );

    # setup ordering
    if ( isset( $_POST['order'] ) )
    {
      # TO-DO: add this code as library
      # this is works only for single ordering
      
      $field_key  = $_POST['order'][0]['column'];
      $field_ord  = $_POST['order'][0]['dir'];
      $field_name = $field_names[ $field_key ];

      if ( strpos($field_name, '.') )
      {
      	list($table, $value) = explode('.', $field_name);

		    $query->join('user_meta', function($join) use ($value) {
		    	$join->on('user.id', '=', 'user_meta.user_id');
		    	$join->where('user_meta.attr', '=', $value);
		    });
		    $query->orderBy( 'user_meta.value', $field_ord );
      }
      else {
      	$query->orderBy( $field_name, $field_ord );
      }
    }

    $query->where( 'parent', auth()->id() );
    
    # add offset
    $query->offset( $_POST['start'] );

    # add limit
    $query->take( $_POST['length'] );    
    $users = $query->lists('user.id');
    $query = null;

    # get total
    #$total = $query->count();
    $total = count($users);

    if ( $total > 0 )
    {
      # filtering and ordering data done, show real data here
      $query = User::with('usermeta')->whereIn( 'id', $users );
      $query->orderByRaw( 'FIELD (id,' . implode(',', $users) . ')' );

      # add offset
      $query->offset( $_POST['start'] );

      # add limit
      $query->take( $_POST['length'] );

      # get data
      $rows = $query->get();
    }

    $data  = [
      'recordsTotal' => $total,
      'recordsFiltered' => $total,
      'data' => []
    ];

    if ( $total > 0 ) {
    #if ( ! $rows->isEmpty() ) {
      foreach ( $rows as $row )
      {
        # TO-DO add this to library
        # create flexibility on assigning data
        $fields = [];
        for ( $i = 0, $c = count($field_names); $i < $c; $i++ )
        {
          if ( $field_names[$i] == 'created_at' ) {
            $fields[] = $row->created_at->toFormattedDateString();
            continue;
          }

          if ( strpos( $field_names[$i], '.' ) !== false )
          {
          	$meta = explode('.', $field_names[$i] );

            if ( $meta[1] == 'solutions' ) {
              $fields[] = $this->solution->metaLists( $this->user->getMeta( $row, $meta[1] ) );
              continue;
            }

          	$fields[] = $this->user->getMeta( $row, $meta[1] );
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