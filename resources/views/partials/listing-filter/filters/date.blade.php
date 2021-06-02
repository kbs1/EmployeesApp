<div class="mb-4">
	<label for="{{ $filter->parameterName() }}" class="text-gray-600 text-sm pb-2 block">{{ $filter->label() }}</label>
	<input autocomplete="off" name="{{ $filter->parameterName() }}" id="{{ $filter->parameterName() }}" type="text" class="input-box datepicker mb-48" value="{{ $filter->currentValue() }}">
</div>