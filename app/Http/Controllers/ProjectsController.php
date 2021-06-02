<?php

namespace App\Http\Controllers;

class ProjectsController extends Controller
{
	public function listing()
	{
		return view('projects.listing', [
			'activePage' => 'projects',
		]);
	}
}
