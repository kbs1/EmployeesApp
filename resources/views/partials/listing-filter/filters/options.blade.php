<div class="mb-3">
	<label for="{{ $filter->parameterName() }}" class="form-label">{{ $filter->label() }}</label>
	<select name="{{ $filter->parameterName() }}" id="{{ $filter->parameterName() }}" size="1" class="form-select">
		<option value="">Choose...</option>
		@foreach ($filter->options() as $value => $text)
			<option value="{{ $value }}"{{ ($filter->currentValue() !== null && $filter->currentValue() == $value) ? ' selected' : '' }}>{{ $text }}</option>
		@endforeach
	</select>
</div>