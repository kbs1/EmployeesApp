<div class="mb-3">
	<label for="{{ $filter->parameterName() }}" class="form-label">{{ $filter->label() }}</label>
	<input autocomplete="off" type="text" name="{{ $filter->parameterName() }}" class="form-control datepicker" id="{{ $filter->parameterName() }}" value="{{ $filter->currentValue() }}">
</div>