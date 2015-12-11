<?php
namespace App\Controllers\Manager\Testimonial;
use App\Controllers\Manager\Controller;
use App\Repositories\PageRepository;
use abeautifulsite\SimpleImage;

class TestimonialController extends Controller
{
  protected $page;
  public function __construct( PageRepository $page )
  {
    parent::__construct();
    $this->page = $page;
  }

  public function index()
  {
    if ( request()->ajax() )
    {
      if ( request()->has('delete') ) {
        $data = $this->page->find( request()->get('delete') );

        if ( $data ){
          $data->delete();
          return 1;
        }
      }
      else {
        return $this->ajaxlist();
      }
    }

		$this->setPageTitle('Testimonials');
    $this->setBreadcrumb([
      'admin.testimonials' => 'Testimonials'
    ]);
    return view()->make('manager.testimonials.index');
  }

  public function create()
  {
  	$this->setPageTitle('Add new testimonial');
  	if ( request()->isMethod('post') )
  	{
  		$input = request()->all();
  		$validator = $this->validate($input);
  		if ( $validator->fails() ) {
        request()->flash();
        return view()->make('manager.testimonials.form')->withInput($input)->withErrors($validator);
  		}
  		else {
        $testimonial = $this->page->getModel();
        $testimonial->title = $input['title'];
        $testimonial->description = $input['description'];
        $testimonial->type = 'testimonial';

  			if ( $testimonial->save() ) {
          $this->handle_image( $testimonial );
  				session()->flash('message', 'Testimonial by ' . $input['title'] . ' is added');
  			}
  		}
  	}
  	
  	return view()->make('manager.testimonials.form');
  }

  public function update( $id )
  {
  	$this->setPageTitle('Edit testimonial');
  	$data = $this->page->find($id);

  	if ( request()->isMethod('post') )
  	{
  		$input = request()->all();
  		$validator = $this->validate($input);

  		if ( $validator->fails() ) {
        request()->flash();
        return view()->make('manager.testimonials.form')->withInput($input)->withErrors($validator);
  		}
  		else {
        $data->title = $input['title'];
        $data->description = $input['description'];
        $data->type = 'testimonial';
        if ( $data->save() ) {
          $this->handle_image( $data );
  				session()->flash('message', 'Testimonial by ' . $input['title'] . ' is updated');
  			}
  		}
  	}

  	return view()->make('manager.testimonials.form', compact('data'));
  }

  protected function handle_image( $data )
  {
    $image = null;

    if ( request()->has('delete_image') ) {
      $fullpath = public_path() . '/uploads/' . $image->image;
      @unlink($fullpath);
      $fullpath = null;
    }

    if ( request()->hasFile('image') ) {
      $image = request()->file('image');
      if ( $image->isValid() )
      {
        $valid_ext = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
        $ext = $image->getClientOriginalExtension();

        if ( in_array($ext, $valid_ext) ) {
          $fullpath = public_path() . '/uploads/' . $image->getClientOriginalName();
          $target = $image->move( public_path() . '/uploads', $image->getClientOriginalName() );

          # RESIZE
          if ( file_exists($fullpath) ) {
            $newpath = public_path() . '/uploads/testimonial_' . $data->id . '.' . $ext;

            if ( file_exists($newpath) ) {
              @unlink($newpath);
            }

            $resize = new SimpleImage( $fullpath );
            $resize->best_fit(100, 100);
            $resize->save( $newpath );
            @unlink($fullpath);

            # SAVE IMAGE FILENAME
            $data->image = 'testimonial_' . $data->id . '.' . $ext;
            $data->save();
          }
        }
        # WRONG IMAGE FORMAT
        else {

        }
      }
    }
  }

  public function ajaxlist()
  {
    $field_names = [
      'title',
    ];

    # init query object
    $query = $this->page->query();
    $query->where('type', 'testimonial');

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
        <li><a class="action-edit" href="<?php echo route('admin.testimonials.update', ['id' => $row->id]) ?>"><i class="fa falist fa-edit"></i>Edit</a></li>
        <li><a class="action-delete" href="#" data-id="<?php echo $row->id?>" data-name="testimonial by '<?php echo $row->title?>'"><i class="fa falist fa-trash"></i>Delete</a></li>
      </ul>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }

  protected function validate( $data )
  {
    $messages = array(
      'title.required'  => 'Author is required'
    );

    $rules = [
      'title'  => 'required',
    ];

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
  }

}