@component('admin.components.modal')
	@slot('id')
		filters-modal-{{ $column->id() }}
	@endslot

	@slot('width')
		w-1/2
	@endslot

	@slot('title')
		{{ $column->name() }}
	@endslot

	<form action="" method="get">
		{!! array_to_hidden_inputs($column->otherColumnsParameters()) !!}

		@foreach ($column->filters() as $filter)
			{!! $filter->render() !!}
		@endforeach

		<div class="flex justify-end pt-2">
			<button type="submit" class="button bg-primary border-primary text-white">Filtrovať</button>
		</div>
	</form>
@endcomponent