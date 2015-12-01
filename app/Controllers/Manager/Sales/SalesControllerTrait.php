<?php
namespace App\Controllers\Manager\Sales;

trait SalesControllerTrait
{
  public function ajaxlist()
  {
    $field_names = [
      'fullname',
      'usermail',
      'mobile',
    ];

    # init query object
    $query = $this->sales->query();

    $search = request()->get('search');
    if ( $search['value'] != '' ) {
      $search = request()->get('search');
      $query->where('fullname', 'like', '%' . $search['value'] . '%');
      $query->orWhere('usermail', 'like', '%' . $search['value'] . '%');
      $query->orWhere('mobile', 'like', '%' . $search['value'] . '%');
    }

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
    <a class="action-edit btn-sm btn-light btn-icon" title="Edit" href="<?php echo route('admin.sales.update', ['id' => $row->id]) ?>"><i class="fa fa-edit"></i></a>
    <a class="action-delete btn-sm btn-light btn-icon" title="Delete" href="<?php echo route('admin.sales', ['id' => $row->id]) ?>" data-id="<?php echo $row->id?>" data-name="'<?php echo $row->fullname?>'"><i class="fa fa-trash"></i></a>
    <a class="action-view btn-sm btn-light btn-icon" title="View" href="<?php echo route('admin.sales.leads', ['id' => $row->id]) ?>"><i class="fa fa-group"></i></a>    
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