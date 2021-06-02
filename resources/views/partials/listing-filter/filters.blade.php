@component('components.modal')
	@slot('id')
		filters-modal-{{ $column->id() }}
	@endslot

	@slot('width')
		w-1/2
	@endslot

	@slot('title')
		Filter {{ strtolower($column->name()) }}
	@endslot

	<form action="" method="get">
		{!! array_to_hidden_inputs($column->otherColumnsParameters()) !!}

		<div class="modal-body">
			@foreach ($column->filters() as $filter)
				{!! $filter->render() !!}
			@endforeach
		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Filter</button>
		</div>
	</form>
@endcomponent