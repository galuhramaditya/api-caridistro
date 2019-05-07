<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Customer extends Model
{

	use Uuid;

	protected $table	= 'customer';
    public $incrementing= false;
}
