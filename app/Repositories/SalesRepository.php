<?php
namespace App\Repositories;
use App\Models\Sales;

class SalesRepository
{
  protected $model;
  public function __construct(Sales $model)
  {
    $this->model = $model;
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

  public function create( $input )
  {
    return $this->model->create( $input );
  }

  public function validate( $input, $id = null )
  {
    return Sales::validate( $input, $id );
  }
}