<div class="mb-4">
	<label for="{{ $filter->parameterName() }}" class="text-gray-600 text-sm pb-2 block">{{ $filter->label() }}</label>
	<select name="{{ $filter->parameterName() }}" id="{{ $filter->parameterName() }}" type="text" class="input-box select2" size="1">
		<option value="">Vyberte...</option>
		@foreach ($filter->options() as $value => $text)
			<option value="{{ $value }}"{{ ($filter->currentValue() !== null && $filter->currentValue() == $value) ? ' selected' : '' }}>{{ $text }}</option>
		@endforeach
	</select>
</div>