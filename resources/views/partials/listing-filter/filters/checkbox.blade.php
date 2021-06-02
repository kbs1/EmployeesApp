<div class="form-check mb-3">
	<input class="form-check-input" type="checkbox" name="{{ $filter->parameterName() }}" id="{{ $filter->parameterName() }}" value="1"{{ $filter->currentValue() ? ' checked' : '' }}>
	<label class="form-check-label" for="{{ $filter->parameterName() }}">
		{{ $filter->label() }}
	</label>
</div>