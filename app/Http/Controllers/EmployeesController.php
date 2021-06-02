<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Support\ListingFilter\Filter;

class EmployeesController extends Controller
{
	public function listing()
	{
		return view('employees.listing', [
			'activePage' => 'employees',
			'entries' => $this->entries(),
		]);
	}

	protected function entries()
	{
		$filter = (new Filter(Employee::query()))
			->templatesPath('partials.listing-filter')
			->perPage(20);

		$surname = $filter->addColumn('surname')
			->name('Surname')
			->sortable(true)
			->sortByDefault(true)
			->sortDefaultDirection('asc');

		$surname->addContainsValueFilter()
			->label('Surname contains');

		$name = $filter->addColumn('name')
			->sortable(true)
			->name('Name');

		$name->addContainsValueFilter()
			->label('Name contains');

		$position = $filter->addColumn('position')
			->sortable(true)
			->name('Position');

		$position->addContainsValueFilter()
			->label('Position contains');

		$age = $filter->addColumn('age')
			->name('Age')
			->sortable(true);

		$age->addValueRangeFilter()
			->label('Age from - to')
			->min(0)
			->step(1);

		$gender = $filter->addColumn('gender')
			->name('Gender');

		$gender->addOptionsFilter()
			->options([
				'male'   => 'Male',
				'female' => 'Female',
			]);

		$rate = $filter->addColumn('hourly_rate')
			->name('Rate')
			->sortable(true);

		$rate->addValueRangeFilter()
			->min(0)
			->step(0.01);

		$employed_at = $filter->addColumn('employed_at')
			->name('Employed at')
			->sortable(true);

		$employed_at->addDateRangeFilter();

		return $filter;
	}
}
