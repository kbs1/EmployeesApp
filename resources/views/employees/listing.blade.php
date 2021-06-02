@extends('layout')

@section('title')
	Employees
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
				<td>{{ $employee->rate }} EUR/MH</td>
				<td>{{ $order->employed_at->format('d.m.Y') }}</td>
				<td>
					//
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