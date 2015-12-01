<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserSolution extends Model
{
  protected $table = 'user_solution';
  protected $fillable = ['user_id', 'solution_id'];
  public $timestamps = false;
}