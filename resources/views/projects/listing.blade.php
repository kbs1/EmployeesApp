@extends('layout')

@section('title')
	Projects
@endsection

@section('controls')
	<a href="{{ route('projects.add') }}" class="btn btn-outline-success" type="button">
		<i class="fas fa-plus me-1"></i> Add project
	</a>
@endsection

@section('content')
	<table class="table table-hover">
		<thead>
			<tr>
				{!! $entries->column('name')->render() !!}
				{!! $entries->column('technology')->render() !!}
				{!! $entries->column('client')->render() !!}
				{!! $entries->column('hourly_rate')->render() !!}
				<th></th>
			</tr>
		</thead>

		<tbody>
		@forelse ($entries->paginatedResults() as $project)
			<tr>
				<td>{{ $project->name }}</td>
				<td>{{ $project->technology }}</td>
				<td>{{ $project->client }}</td>
				<td>{{ $project->hourly_rate }} &euro;/MH</td>
				<td>
					<a href="{{ route('projects.edit', $project->id) }}" data-bs-toggle="tooltip" title="Edit" class="me-1"><i class="fas fa-edit"></i></a>
					<a href="{{ route('projects.delete', $project->id) }}" data-bs-toggle="tooltip" title="Delete" class="text-danger" onclick="return confirm('Are you sure you want to delete this project?')"><i class="fas fa-trash"></i></a>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="8"><div class="text-center">No projects.</div></td>
			</tr>
		@endforelse
		</tbody>
	</table>

	{{ $entries->links() }}

	@foreach ($entries->columns() as $column)
		{!! $column->renderFilters() !!}
	@endforeach
@endsection
