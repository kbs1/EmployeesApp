<th>
	<span class="me-1">{{ $column->name() }}</span>

	@if ($column->sortable())
		@if ($column->isSorting())
			@if ($column->sortDirection() == 'desc')
				<a href="{{ $column->sortUrl('asc') }}" class="me-1" data-bs-toggle="tooltip" title="Sort ascending"><i class="fas fa-sort-up"></i></a>
			@else
				<a href="{{ $column->sortUrl('desc') }}" class="me-1" data-bs-toggle="tooltip" title="Sort descending"><i class="fas fa-sort-down"></i></a>
			@endif
		@else
			<a href="{{ $column->sortUrl('desc') }}" class="me-1" data-bs-toggle="tooltip" title="Sort descending"><i class="fas fa-sort-down text-muted"></i></a>
		@endif
	@endif

	@if ($column->hasFilters())
		@if ($column->isFiltering())
			<span data-bs-toggle="tooltip" title="Filter">
				<a href="#" title="{{ $column->filtersText() }}" data-bs-toggle="modal" data-bs-target="#filters-modal-{{ $column->id() }}"><i class="fas fa-search"></i></a>
			</span>
		@else
			<span data-bs-toggle="tooltip" title="Filter">
				<a href="#" title="Filter" data-bs-toggle="modal" data-bs-target="#filters-modal-{{ $column->id() }}"><i class="fas fa-search text-muted"></i></a>
			</span>
		@endif
	@endif
</th>
