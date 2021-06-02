@extends('layout')

@section('title')
	Employees
@endsection

@section('controls')
	<a href="{{ route('employees.add') }}" class="btn btn-outline-success" type="button">
		<i class="fas fa-plus me-1"></i> Add employee
	</a>
@endsection

@section('content')
	<table class="table table-hover">
		<thead>
			<tr>
				{!! $entries->column('surname')->render() !!}
				{!! $entries->column('name')->render() !!}
				{!! $entries->column('position')->render() !!}
				{!! $entries->column('age')->render() !!}
				{!! $entries->column('gender')->render() !!}
				{!! $entries->column('hourly_rate')->render() !!}
				{!! $entries->column('employed_at')->render() !!}
				<th></th>
			</tr>
		</thead>

		<tbody>
		@forelse ($entries->paginatedResults() as $employee)
			<tr>
				<td>{{ $employee->surname }}</td>
				<td>{{ $employee->name }}</td>
				<td>{{ $employee->position }}</td>
				<td>{{ $employee->age }}</td>
				<td>{{ $employee->gender }}</td>
				<td>{{ $employee->hourly_rate }} &euro;/MH</td>
				<td>{{ $employee->employed_at->format('d.m.Y') }}</td>
				<td>
					<a href="{{ route('employees.edit', $employee->id) }}" data-bs-toggle="tooltip" title="Edit" class="me-1"><i class="fas fa-edit"></i></a>
					<a href="{{ route('employees.delete', $employee->id) }}" data-bs-toggle="tooltip" title="Delete" class="text-danger" onclick="return confirm('Are you sure you want to delete this employee?')"><i class="fas fa-trash"></i></a>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="8"><div class="text-center">No employees.</div></td>
			</tr>
		@endforelse
		</tbody>
	</table>

	{{ $entries->links() }}

	@foreach ($entries->columns() as $column)
		{!! $column->renderFilters() !!}
	@endforeach
@endsection