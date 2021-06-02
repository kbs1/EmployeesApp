<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class DashboardController extends Controller
{
	public function index()
	{
		$minAge = Employee::min('age');
		$ageChart = array_fill($minAge, Employee::max('age') - $minAge + 1, 0);
		$ageChart = Employee::all()->groupBy('age')->map(fn($group) => count($group))->toArray() + $ageChart;
		ksort($ageChart);

		return view('dashboard', [
			'activePage' => 'dashboard',
			'ageChart' => $ageChart,
		]);
	}
}
