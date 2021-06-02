<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

use Orbit\Concerns\Orbital;

class Project extends Model
{
	use Orbital;

	protected $guarded = [];

	public static function schema(Blueprint $table)
	{
		$table->increments('id');
		$table->string('name');
		$table->string('technology');
		$table->string('client');
		$table->decimal('hourly_rate');
	}
}
