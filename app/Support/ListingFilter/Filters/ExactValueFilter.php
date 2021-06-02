<?php

namespace App\Support\ListingFilter\Filters;

class ExactValueFilter extends BaseFilter
{
	/* filtering */
	public function applyFilter($query)
	{
		if (is_string($field_or_callback = $this->fieldOrCallback())) {
			$query->where($field_or_callback, $this->currentValue());
		} else {
			$field_or_callback($query, $this->currentValue());
		}
	}
}
