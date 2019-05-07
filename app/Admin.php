<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Admin extends Model
{
	use Uuid;

	protected $table = 'admin';
	protected $fillable = [
		'username', 'password'
	];
	public $incrementing = false;
}
