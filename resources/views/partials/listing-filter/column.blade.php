<th>
	<span class="mr-3">{{ $column->name() }}</span>

	@if ($column->sortable())
		@if ($column->isSorting())
			@if ($column->sortDirection() == 'desc')
				<a href="{{ $column->sortUrl('asc') }}" class="mr-3" v-tooltip="'Sort descending'"><i class="fas fa-sort-up"></i></a>
			@else
				<a href="{{ $column->sortUrl('desc') }}" class="mr-3" v-tooltip="'Sort ascending'"><i class="fas fa-sort-down"></i></a>
			@endif
		@else
			<a href="{{ $column->sortUrl('desc') }}" class="mr-3" v-tooltip="'Sort ascending'"><i class="fas fa-sort-down text-muted"></i></a>
		@endif
	@endif

	@if ($column->hasFilters())
		@if ($column->isFiltering())
			<a href="#" v-tooltip="'{{ $column->filtersText() }}'" onclick="toggleModal('filters-modal-{{ $column->id() }}');@if ($column->firstFilter()) var el = document.getElementById('{{ $column->firstFilter()->parameterName() }}'); if (el) el.focus();@endif return false;"><i class="fas fa-search"></i></a>
		@else
			<a href="#" v-tooltip="'Filtrovať'" onclick="toggleModal('filters-modal-{{ $column->id() }}');@if ($column->firstFilter()) var el = document.getElementById('{{ $column->firstFilter()->parameterName() }}'); if (el) el.focus();@endif return false;"><i class="fas fa-search text-muted"></i></a>
		@endif
	@endif
</th>
