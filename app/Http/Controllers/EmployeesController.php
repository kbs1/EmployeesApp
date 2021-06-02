<?php

namespace App\Http\Controllers;

class EmployeesController extends Controller
{
	public function listing()
	{
		return view('employees.listing', [
			'activePage' => 'employees',
		]);
	}
}
