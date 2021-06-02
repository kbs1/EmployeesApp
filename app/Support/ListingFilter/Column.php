<?php

namespace App\Support\ListingFilter;

use App\Support\ListingFilter\Filters\{ExactValueFilter, ContainsValueFilter, ValueRangeFilter};
use App\Support\ListingFilter\Filters\{DateFilter, DateRangeFilter};
use App\Support\ListingFilter\Filters\{CheckboxFilter, OptionsFilter};

use App\Support\FluentGetterSetter;

class Column
{
	use FluentGetterSetter;

	protected $filter, $id, $name;
	protected $sortable = false, $sort_by_default = false, $sort_default_direction = 'desc';
	protected $sort_by;
	protected $filters = [];
	protected $templates_path;

	public function __construct(Filter $filter, string $id)
	{
		$this->filter = $filter;
		$this->id = $id;
		$this->name = $id;
		$this->sort_by = $id;
	}

	/* reference to main filter */
	public function filter()
	{
		return $this->filter;
	}

	/* column properties */
	public function id(string $new = null)
	{
		return $this->getOrSet('id', $new);
	}

	public function name(string $new = null)
	{
		return $this->getOrSet('name', $new);
	}

	public function templatesPath(string $new = null)
	{
		return $this->getOrSet('templates_path', $new);
	}

	/* column sorting */
	public function sortable(bool $new = null)
	{
		return $this->getOrSet('sortable', $new);
	}

	public function sortByDefault(bool $new = null)
	{
		return $this->getOrSet('sort_by_default', $new);
	}

	public function sortDefaultDirection(string $new = null)
	{
		return $this->getOrSet('sort_default_direction', $new);
	}

	public function sortBy($new = null)
	{
		return $this->getOrSet('sort_by', $new);
	}

	/* column filters */
	public function filters()
	{
		return $this->filters;
	}

	public function firstFilter()
	{
		return $this->filters[0] ?? null;
	}

	public function hasFilters()
	{
		return count($this->filters()) > 0;
	}

	public function addExactValueFilter()
	{
		return $this->addFilter(ExactValueFilter::class);
	}

	public function addContainsValueFilter()
	{
		return $this->addFilter(ContainsValueFilter::class);
	}

	public function addValueRangeFilter()
	{
		return $this->addFilter(ValueRangeFilter::class);
	}

	public function addDateFilter()
	{
		return $this->addFilter(DateFilter::class);
	}

	public function addDateRangeFilter()
	{
		return $this->addFilter(DateRangeFilter::class);
	}

	public function addCheckboxFilter()
	{
		return $this->addFilter(CheckboxFilter::class);
	}

	public function addOptionsFilter()
	{
		return $this->addFilter(OptionsFilter::class);
	}

	/* rendering */
	public function render()
	{
		if ($this->templatesPath() === null)
			throw new \RuntimeException('Can not render column without templates path.');

		return view($this->templatesPath() . '.column', [
			'column' => $this,
		])->render();
	}

	public function renderFilters()
	{
		if (!$this->hasFilters())
			return '';

		return view($this->templatesPath() . '.filters', [
			'column' => $this,
		])->render();
	}

	public function otherColumnsParameters()
	{
		$parameters = $this->filter()->parameters();

		foreach ($this->filters() as $filter) {
			unset($parameters[$filter->parameterName()]);
		}

		return $parameters;
	}

	public function filtersText()
	{
		if (!$this->hasFilters())
			return '';

		$texts = [];
		foreach ($this->filters() as $filter) {
			$text = $filter->filterText();

			if ($text !== null)
				$texts[] = e($text);
		}

		return implode('<br>', $texts);
	}

	/* column run-time sorting */
	public function isSorting()
	{
		$value = $this->filter()->parameterValue('sort-by');

		if ($value === $this->id())
			return true;

		// are we sorting by default using this column?
		if ($value === null && $this->sortByDefault())
			return true;

		return false;
	}

	public function sortDirection()
	{
		$value = $this->filter()->parameterValue('sort-direction');

		// are we sorting by default using this column?
		if ($value === null && $this->sortByDefault())
			return $this->sortDefaultDirection() === 'asc' ? 'asc' : 'desc';

		return $value === 'asc' ? 'asc' : 'desc';
	}

	public function sortUrl(string $direction)
	{
		$parameters = $this->filter()->parameters();
		$parameters['sort-by'] = $this->id();
		$parameters['sort-direction'] = $direction === 'asc' ? 'asc' : 'desc';

		return '?' . http_build_query($parameters);
	}

	/* column run-time filtering */
	public function isFiltering()
	{
		if (!$this->hasFilters())
			return false;

		foreach ($this->filters() as $filter) {
			if ($filter->currentValue() !== null)
				return true;
		}

		return false;
	}

	/* column apply filters / sorting */
	public function apply($query)
	{
		// handle sorting
		if ($this->sortable() && $this->isSorting()) {
			$sort_by = $this->sortBy();

			if (is_string($sort_by)) {
				$query->orderBy($sort_by, $this->sortDirection());
			} else {
				$sort_by($query, $this->sortDirection());
			}
		}

		// handle filters
		foreach ($this->filters() as $filter) {
			$filter->apply($query);
		}

		return $query;
	}

	/* protected methods */
	protected function addFilter(string $class)
	{
		$filter = new $class($this, (string) count($this->filters));
		$this->filters[] = $filter;

		$filter->fieldOrCallback($this->id());
		$filter->templatesPath($this->templatesPath());

		try {
			$filter->currentValue($this->filter()->parameterValue($filter->parameterName()));
		} catch (\InvalidArgumentException $ex) {}

		return $filter;
	}
}
