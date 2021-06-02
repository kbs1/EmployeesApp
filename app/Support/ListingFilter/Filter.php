<?php

namespace App\Support\ListingFilter;

use App\Support\FluentGetterSetter;

class Filter
{
	use FluentGetterSetter;

	protected $query, $columns = [];
	protected $templates_path;
	protected $per_page = 15;
	protected $paginated_results;

	public function __construct($query)
	{
		$this->query = $query;
	}

	/* filter properties */
	public function templatesPath(string $new = null)
	{
		return $this->getOrSet('templates_path', $new);
	}

	public function perPage(int $new = null)
	{
		return $this->getOrSet('per_page', $new);
	}

	/* columns */
	public function column(string $id)
	{
		foreach ($this->columns() as $column)
			if ($column->id() == $id)
				return $column;

		throw new \InvalidArgumentException('Column "' . $id . '" does not exist.');
	}

	public function columns()
	{
		return $this->columns;
	}

	public function addColumn(string $id)
	{
		$column = new Column($this, $id);
		$this->columns[] = $column;

		$column->templatesPath($this->templatesPath());

		return $column;
	}

	/* results */
	public function paginatedResults()
	{
		return $this->paginated_results = $this->query()->paginate($this->perPage());
	}

	public function allResults()
	{
		return $this->query()->get();
	}

	/* rendering */
	public function links()
	{
		if ($this->templatesPath() === null)
			throw new \RuntimeException('Can not render links without templates path.');

		if (!$this->paginated_results)
			return '';

		return $this->paginated_results->appends($this->parameters())->links($this->templatesPath() . '.pagination');
	}

	/* filter parameters */
	public function parameters()
	{
		$parameters = [];

		foreach ($this->columns() as $column) {
			foreach ($column->filters() as $filter) {
				$value = request()->query($filter->parameterName());

				if ($value !== null && (is_string($value) || (is_array($value) && count(array_filter($value, 'strlen')) > 0)))
					$parameters[$filter->parameterName()] = $value;
			}
		}

		// add sort-by and sort-direction if present
		foreach (['sort-by', 'sort-direction'] as $parameter)
			if ($value = request()->query($parameter))
				$parameters[$parameter] = $value;

		return $parameters;
	}

	public function parameterValue(string $parameter)
	{
		return $this->parameters()[$parameter] ?? null;
	}

	/* protected functions */
	protected function query()
	{
		foreach ($this->columns() as $column) {
			$column->apply($this->query);
		}

		return $this->query;
	}
}
