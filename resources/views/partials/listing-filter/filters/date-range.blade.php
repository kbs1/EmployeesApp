<div class="mb-4">
	<label class="text-gray-600 text-sm pb-2 block">{{ $filter->label() }}</label>

	<div class="flex mb-48">
		<input autocomplete="off" name="{{ $filter->parameterName() }}[0]" type="text" class="input-box datepicker w-1/2 mr-4" value="{{ $filter->currentValue()[0] ?? '' }}">
		<input autocomplete="off" name="{{ $filter->parameterName() }}[1]" type="text" class="input-box datepicker w-1/2" value="{{ $filter->currentValue()[1] ?? '' }}">
	</div>
</div>