@extends('layout')

@section('title')
	Add employee
@endsection

@section('content')
	<h1>{{ $employee->exists ? 'Update' : 'Add' }} employee</h1>

	<form action="{{ $employee->exists ? route('employees.update', $employee->id) : route('employees.create') }}" method="post">
		@csrf

		@if ($employee->exists)
			@method('put')
		@endif

		<div class="mb-3">
			<label for="name" class="form-label">Name</label>
			<input autocomplete="off" type="text" name="name" class="form-control" id="name" value="{{ old('name', $employee->name) }}" required>
		</div>

		<div class="mb-3">
			<label for="surname" class="form-label">Surname</label>
			<input autocomplete="off" type="text" name="surname" class="form-control" id="surname" value="{{ old('surname', $employee->surname) }}" required>
		</div>

		<div class="mb-3">
			<label for="position" class="form-label">Position</label>
			<input autocomplete="off" type="text" name="position" class="form-control" id="position" value="{{ old('position', $employee->position) }}" required>
		</div>

		<div class="mb-3">
			<label for="age" class="form-label">Age</label>
			<input autocomplete="off" type="number" min="0" step="1" name="age" class="form-control" id="age" value="{{ old('age', $employee->age) }}" required>
		</div>

		<div class="mb-3">
			<label for="gender" class="form-label">Gender</label>
			<select name="gender" class="form-control" id="gender" required>
				<option value="">Choose...</option>
				<option value="male"{{ old('gender', $employee->gender) == 'male' ? ' selected' : '' }}>Male</option>
				<option value="female"{{ old('gender', $employee->gender) == 'female' ? ' selected' : '' }}>Female</option>
			</select>
		</div>

		<div class="mb-3">
			<label for="employed_at" class="form-label">Employed at</label>
			<input autocomplete="off" type="text" name="employed_at" class="form-control datepicker" id="employed_at" value="{{ old('employed_at', $employee->employed_at) }}" required>
		</div>

		<div class="mb-3">
			<label for="hourly_rate" class="form-label">Hourly rate</label>
			<div class="input-group">
				<input autocomplete="off" type="number" min="0" step="0.1" name="hourly_rate" class="form-control" id="hourly_rate" value="{{ old('hourly_rate', $employee->hourly_rate) }}" required>
				<span class="input-group-text">&euro;/MH</span>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Save</button>
	</form>
@endsection