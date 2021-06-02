<?php

namespace App\Support\ListingFilter\Filters;

use App\Support\ListingFilter\Column;
use App\Support\FluentGetterSetter;

abstract class BaseFilter
{
	use FluentGetterSetter;

	protected $column, $id, $label;
	protected $field_or_callback;
	protected $templates_path;
	protected $parameter_name, $current_value;

	public function __construct(Column $column, string $id)
	{
		$this->column = $column;
		$this->id = $id;
		$this->label = $column->name();
		$this->parameter_name = $column->id() . '-' . $id;
	}

	/* reference to column */
	public function column()
	{
		return $this->column;
	}

	/* filter properties */
	public function id(string $new = null)
	{
		return $this->getOrSet('id', $new);
	}

	public function label(string $new = null)
	{
		return $this->getOrSet('label', $new);
	}

	public function fieldOrCallback($new = null)
	{
		return $this->getOrSet('field_or_callback', $new);
	}

	public function templatesPath(string $new = null)
	{
		return $this->getOrSet('templates_path', $new);
	}

	public function parameterName(string $new = null)
	{
		return $this->getOrSet('parameter_name', $new);
	}

	public function currentValue($new = null)
	{
		if ($new !== null && !is_string($new))
			throw new \InvalidArgumentException('Filter value must be null or string.');

		return $this->getOrSet('current_value', $new);
	}

	/* rendering */
	public function render()
	{
		if ($this->templatesPath() === null)
			throw new \RuntimeException('Can not render filter without templates path.');

		$view = \Str::kebab(substr(class_basename(get_class($this)), 0, -6));
		return view($this->templatesPath() . '.filters.' . $view, [
			'filter' => $this,
		]);
	}

	public function filterText()
	{
		if ($this->currentValue() === null)
			return null;

		return $this->label() . ': ' . $this->currentValue();
	}

	/* filtering */
	public function apply($query)
	{
		if ($this->currentValue() === null)
			return;

		return $this->applyFilter($query);
	}

	public abstract function applyFilter($query);
}
