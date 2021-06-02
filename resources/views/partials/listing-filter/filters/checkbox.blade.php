<div class="d-flex align-items-center mb-4">
	<input name="{{ $filter->parameterName() }}" id="{{ $filter->parameterName() }}" type="checkbox" value="1"{{ $filter->currentValue() ? ' checked' : '' }}>
	<label for="{{ $filter->parameterName() }}" class="ml-2 text-gray-600 text-sm d-block">{{ $filter->label() }}</label>
</div>
