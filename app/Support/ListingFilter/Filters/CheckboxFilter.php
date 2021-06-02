<?php

namespace App\Support\ListingFilter\Filters;

class CheckboxFilter extends BaseFilter
{
	/* filter properties */
	public function filterText()
	{
		if ($this->currentValue() === null)
			return null;

		return $this->label() . ': ' . ($this->currentValue() ? 'Áno' : 'Nie');
	}

	/* filtering */
	public function applyFilter($query)
	{
		if (is_string($field_or_callback = $this->fieldOrCallback())) {
			$query->whereRaw($field_or_callback);
		} else {
			$field_or_callback($query);
		}
	}
}
