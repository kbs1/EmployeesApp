<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

use Orbit\Concerns\Orbital;

class Employee extends Model
{
	use Orbital;

	protected $guarded = [];
	protected $dates = ['employed_at'];

	public static function schema(Blueprint $table)
	{
		$table->increments('id');
		$table->string('name');
		$table->string('surname');
		$table->string('position');
		$table->integer('age');
		$table->enum('gender', ['male', 'female']);
		$table->date('employed_at');
		$table->decimal('hourly_rate');
	}
}
