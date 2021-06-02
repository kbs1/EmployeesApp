<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Employee;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker::create();

		for ($i = 0; $i < 100; $i++) {
			Employee::create([
				'name' => $faker->firstName(),
				'surname' => $faker->lastName(),
				'position' => $faker->jobTitle(),
				'age' => rand(18, 45),
				'gender' => ['male', 'female'][rand(0, 1)],
				'employed_at' => now()->subYears(rand(0, 5))->subMonths(rand( 0, 5))->subDays(rand(0, 30)),
				'hourly_rate' => rand(15, 40),
			]);
		}
	}
}
