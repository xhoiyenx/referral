<?php
namespace App\Controllers\Manager\Solution;
use App\Controllers\Manager\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\Solution;

class SolutionController extends Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    if ( request()->ajax() )
    {
      if ( request()->has('delete') ) {
        $data = Solution::find( request()->get('delete') );

        if ( $data ){
          $data->delete();
          return 1;
        }
      }
      else {
        return $this->ajaxlist();
      }
    }

		$this->setPageTitle('Solutions');
    $this->setBreadcrumb([
      'admin.solution' => 'Solutions'
    ]);
    return view()->make('solution.index');
  }

  public function create()
  {
  	$this->setPageTitle('Add new solution');
  	if ( request()->isMethod('post') )
  	{
  		$input = request()->all();
  		$validator = Solution::validate($input);
  		if ( $validator->fails() ) {
  			#return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
  			request()->flash();
  			return view()->make('solution.create')->withErrors($validator);
  		}
  		else {
  			$solution = Solution::create($input);
  			if ($solution) {
  				session()->flash('message', 'Solution ' . $input['name'] . ' added');
  				return view()->make('solution.create');
  			}
  		}
  	}
  	
  	return view()->make('solution.create');
  }

  public function update( $id )
  {
  	$this->setPageTitle('Edit Solution');
  	$data = Solution::find($id);

  	if ( request()->isMethod('post') )
  	{
  		$input = request()->all();
  		$validator = Solution::validate($input);

  		if ( $validator->fails() ) {
  			#return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
  			request()->flash();
  			return view()->make('solution.create', compact('data'))->withErrors($validator);
  		}
  		else {
  			$solution = $data->fill($input)->save();
  			if ($solution) {
  				session()->flash('message', 'Solution ' . $input['name'] . ' saved');
  				return view()->make('solution.create', compact('data'));
  			}
  		}
  	}

  	return view()->make('solution.create', compact('data'));
  }

  public function ajaxlist()
  {
    $field_names = [
      'name',
      'price',
      'fee',
    ];

    # init query object
    $query = Solution::query();

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

    # get total
    $total = $query->count();

    # add offset
    $query->offset( $_POST['start'] );

    # add limit
    $query->take( $_POST['length'] );

    # get data
    $rows = $query->get();

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
          $fields[] = $row->$field_names[$i];
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
        <li><a class="action-edit" href="<?php echo route('admin.solution.update', ['id' => $row->id]) ?>"><i class="fa falist fa-edit"></i>Edit</a></li>
        <li><a class="action-delete" href="#" data-id="<?php echo $row->id?>" data-name="'<?php echo $row->name?>'"><i class="fa falist fa-trash"></i>Delete</a></li>
      </ul>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }  

}