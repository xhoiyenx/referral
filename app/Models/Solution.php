<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
  protected $table = 'solutions';
  protected $fillable = ['name', 'image', 'price', 'fee', 'description', 'sort_order'];
  public $timestamps = false;

  protected function validate( $data )
  {
    $messages = array(
      'name.required'  => 'Name is required',
      'price.required' => 'Price is required',
      'fee.required'   => 'Referral fee is required',
    );

    $rules = [
      'name'  => 'required',
      'price' => 'required',
      'fee'   => 'required',
    ];

    $validator = validator()->make( $data, $rules, $messages );
    return $validator;
  }
}