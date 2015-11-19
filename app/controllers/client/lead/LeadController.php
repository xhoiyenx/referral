<?php
namespace App\Controllers\Client\Lead;
use App\Controllers\Client\Controller;
use App\Repositories\UserRepository;
use App\Models\User;

class LeadController extends Controller
{
	protected $user;
	public function __construct( UserRepository $user )
	{
		parent::__construct();
		$this->user = $user;
	}

	public function index()
	{
    if ( request()->ajax() )
    {
      if ( request()->has('delete') ) {
        $user = User::find( request()->get('delete') );

        if ( $user ){
          $user->delete();
          return 1;
        }
      }
      else {
        return $this->ajaxlist();
      }
    }

		$this->setPageTitle('Lead');
    $this->setBreadcrumb([
      'client.lead' => 'Lead'
    ]);

		return view()->make('user.lead.index');
	}

	public function create()
	{
		$this->setPageTitle('Add New Lead');
    $this->setBreadcrumb([
      'client.lead' => 'Lead',
      'client.lead.create' => 'Add New Lead',
    ]);

    if ( request()->isMethod('post') )
    {
    	$input = request()->all();
      $validator = User::validate_lead( $input );

      if ( $validator->fails() ) {
        return redirect()->back()->withInput()->withErrors( $validator );
      }
      else {

      	if ( $this->user->saveLead($input) ) {
      		return redirect()->route('client.lead')->withMessage('Lead ' . $input['fullname'] . ' is added');
      	}

      }
    }

		return view()->make('user.lead.create');
	}

  public function ajaxlist()
  {
  	# COMPLEX CODE FOR AJAX TABLE
    $field_names = [
      'created_at',
      'usermeta.company',
      'fullname'
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
        <li><a href="<?php echo route('client.lead.update', ['id' => $row->id]) ?>"><i class="fa falist fa-edit"></i>Edit</a></li>
        <li><a class="action-delete" href="#" data-id="<?php echo $row->id?>" data-name="<?php echo $row->first_name?>"><i class="fa falist fa-trash"></i>Delete</a></li>
      </ul>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }	
}