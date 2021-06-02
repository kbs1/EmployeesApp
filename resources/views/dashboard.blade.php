@extends('layout')

@section('title')
	Welcome
@endsection

@section('content')
	<canvas id="employees-age-chart" class="w-100" height="300"></canvas>
@endsection

@section('scripts')
	<script>
		let labels = [{{ implode(', ', array_keys($ageChart)) }}];
		let data = [{{ implode(', ', $ageChart) }}];
		initDashboardChart(labels, data);
	</script>
@endsection
