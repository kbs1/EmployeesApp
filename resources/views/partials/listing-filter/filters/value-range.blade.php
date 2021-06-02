<div class="mb-4">
	<label class="text-gray-600 text-sm pb-2 block">{{ $filter->label() }}</label>

	<div class="flex">
		<input autocomplete="off" name="{{ $filter->parameterName() }}[0]" type="number" class="input-box w-1/2 mr-4" step="{{ $filter->step() }}"{!! $filter->min() !== null ? ' min="' . $filter->min() . '"' : '' !!}{!! $filter->max() !== null ? ' max="' . $filter->max() . '"' : '' !!} value="{{ $filter->currentValue()[0] ?? '' }}" id="{{ $filter->parameterName() }}">
		<input autocomplete="off" name="{{ $filter->parameterName() }}[1]" type="number" class="input-box w-1/2" step="{{ $filter->step() }}"{!! $filter->min() !== null ? ' min="' . $filter->min() . '"' : '' !!}{!! $filter->max() !== null ? ' max="' . $filter->max() . '"' : '' !!} value="{{ $filter->currentValue()[1] ?? '' }}">
	</div>
</div>