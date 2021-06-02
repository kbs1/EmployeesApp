@extends('layout')

@section('title')
	{{ $project->exists ? 'Update' : 'Add' }} project
@endsection

@section('content')
	<h1>{{ $project->exists ? 'Update' : 'Add' }} project</h1>

	<form action="{{ $project->exists ? route('projects.update', $project->id) : route('projects.create') }}" method="post">
		@csrf

		@if ($project->exists)
			@method('put')
		@endif

		<div class="mb-3">
			<label for="name" class="form-label">Name</label>
			<input autocomplete="off" type="text" name="name" class="form-control" id="name" value="{{ old('name', $project->name) }}" required>
		</div>

		<div class="mb-3">
			<label for="technology" class="form-label">Technology</label>
			<input autocomplete="off" type="text" name="technology" class="form-control" id="technology" value="{{ old('technology', $project->technology) }}" required>
		</div>

		<div class="mb-3">
			<label for="client" class="form-label">Client</label>
			<input autocomplete="off" type="text" name="client" class="form-control" id="client" value="{{ old('client', $project->client) }}" required>
		</div>

		<div class="mb-3">
			<label for="hourly_rate" class="form-label">Hourly rate</label>
			<div class="input-group">
				<input autocomplete="off" type="number" min="0" step="0.1" name="hourly_rate" class="form-control" id="hourly_rate" value="{{ old('hourly_rate', $project->hourly_rate) }}" required>
				<span class="input-group-text">&euro;/MH</span>
			</div>
		</div>

		<button type="submit" class="btn btn-primary">Save</button>
	</form>
@endsection
