<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
  protected $table = 'user_meta';
  protected $fillable = ['user_id', 'attr', 'value'];
  public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}