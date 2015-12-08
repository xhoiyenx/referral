<?php
namespace App\Repositories;
use App\Models\Page;

class PageRepository
{
  protected $model;
  public function __construct(Page $page)
  {
    $this->model = $page;
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

  public function getModel()
  {
    return $this->model;
  }

  public function queryByType( $type = 'post' )
  {
    return $this->model->where('type', $type);
  }
}