<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Support\ListingFilter\Filter;

class ProjectsController extends Controller
{
	public function listing()
	{
		return view('projects.listing', [
			'activePage' => 'projects',
			'entries' => $this->entries(),
		]);
	}

	public function add()
	{
		return view('projects.form', [
			'activePage' => 'projects',
			'project' => new Project,
		]);
	}

	public function create(StoreProjectRequest $request)
	{
		$project = new Project($request->validated());
		$project->save();

		return redirect()->route('projects.listing')->with('success', 'Project successfully created.');
	}

	public function edit($id)
	{
		return view('projects.form', [
			'activePage' => 'projects',
			'project' => Project::findOrFail($id),
		]);
	}

	public function update($id, StoreProjectRequest $request)
	{
		$project = Project::findOrFail($id);
		$project->fill($request->validated());
		$project->save();

		return redirect()->route('projects.listing')->with('success', 'Project successfully updated.');
	}

	public function delete($id)
	{
		$project = Project::findOrFail($id);
		$project->delete();

		return redirect()->route('projects.listing')->with('success', 'Project successfully deleted.');
	}

	protected function entries()
	{
		$filter = (new Filter(Project::query()))
			->templatesPath('partials.listing-filter')
			->perPage(20);

		$name = $filter->addColumn('name')
			->name('Name')
			->sortable(true)
			->sortByDefault(true)
			->sortDefaultDirection('asc');

		$name->addContainsValueFilter()
			->label('Name contains');

		$technology = $filter->addColumn('technology')
			->sortable(true)
			->name('Technology');

		$technology->addContainsValueFilter()
			->label('Technology contains');

		$client = $filter->addColumn('client')
			->sortable(true)
			->name('Client');

		$client->addContainsValueFilter()
			->label('Client name contains');

		$rate = $filter->addColumn('hourly_rate')
			->name('Rate')
			->sortable(true);

		$rate->addValueRangeFilter()
			->min(0)
			->step(0.01);

		return $filter;
	}
}
