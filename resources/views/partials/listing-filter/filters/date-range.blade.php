<div class="mb-3">
	<label class="form-label">{{ $filter->label() }}</label>
	<div class="d-flex">
		<input autocomplete="off" name="{{ $filter->parameterName() }}[0]" type="text" class="form-control min-width-0 datepicker w-1/2 me-2" value="{{ $filter->currentValue()[0] ?? '' }}">
		<input autocomplete="off" name="{{ $filter->parameterName() }}[1]" type="text" class="form-control min-width-0 datepicker w-1/2" value="{{ $filter->currentValue()[1] ?? '' }}">
	</div>
</div>