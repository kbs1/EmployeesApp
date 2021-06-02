<?php

namespace App\Support\ListingFilter\Filters;

use App\Support\ListingFilter\Column;

abstract class BaseRangeFilter extends BaseFilter
{
	public function __construct(Column $column, string $id)
	{
		parent::__construct($column, $id);
		$this->label = $column->name() . ' od - do';
	}

	/* filter properties */
	public function currentValue($new = null)
	{
		if ($new !== null) {
			if (!is_array($new))
				throw new \InvalidArgumentException('Filter value must be null or array.');

			if (!isset($new[0]) && !isset($new[1]))
				throw new InvalidArgumentException('Filter value elements 0 or 1 must be set.');
		}

		return $this->getOrSet('current_value', $new);
	}

	/* rendering */
	public function filterText()
	{
		$value = $this->currentValue();

		if ($value === null)
			return null;

		return $this->label() . ': ' . implode(' - ', [trim($value[0] ?? '') !== '' ? $value[0] : 'neurčené', trim($value[1] ?? '') !== '' ? $value[1] : 'neurčené']);
	}
}
