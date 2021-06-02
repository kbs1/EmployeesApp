<?php

namespace App\Support\ListingFilter\Filters;

use App\Support\FluentGetterSetter;

class OptionsFilter extends ExactValueFilter
{
	use FluentGetterSetter;

	protected $options = [];

	/* filter properties */
	public function options(array $new = null)
	{
		return $this->getOrSet('options', $new);
	}

	/* rendering */
	public function filterText()
	{
		if ($this->currentValue() === null || !isset($this->options()[$this->currentValue()]))
			return null;

		return $this->label() . ': ' . $this->options()[$this->currentValue()];
	}

	/* filtering */
	public function apply($query)
	{
		if ($this->currentValue() === null || !isset($this->options()[$this->currentValue()]))
			return;

		return $this->applyFilter($query);
	}
}
