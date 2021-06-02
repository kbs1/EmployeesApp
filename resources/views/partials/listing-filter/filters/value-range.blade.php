<div class="mb-3">
	<label class="form-label">{{ $filter->label() }}</label>
	<div class="d-flex">
		<input autocomplete="off" name="{{ $filter->parameterName() }}[0]" type="number" class="form-control min-width-0 w-1/2 me-2" step="{{ $filter->step() }}"{!! $filter->min() !== null ? ' min="' . $filter->min() . '"' : '' !!}{!! $filter->max() !== null ? ' max="' . $filter->max() . '"' : '' !!} value="{{ $filter->currentValue()[0] ?? '' }}" id="{{ $filter->parameterName() }}">
		<input autocomplete="off" name="{{ $filter->parameterName() }}[1]" type="number" class="form-control min-width-0 w-1/2" step="{{ $filter->step() }}"{!! $filter->min() !== null ? ' min="' . $filter->min() . '"' : '' !!}{!! $filter->max() !== null ? ' max="' . $filter->max() . '"' : '' !!} value="{{ $filter->currentValue()[1] ?? '' }}">
	</div>
</div>