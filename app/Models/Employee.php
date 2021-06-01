<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

use Orbit\Concerns\Orbital;

class Employee extends Model
{
	use Orbital;

	protected $guarded = [];
	protected $dates = ['published_at'];

	public static function schema(Blueprint $table)
	{
		$table->increments('id');
		$table->string('title');
		$table->string('slug');
		$table->datetime('published_at');
		$table->string('foo');
	}
}
