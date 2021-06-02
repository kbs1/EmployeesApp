<?php

namespace App\Support\ListingFilter\Filters;

use Carbon\Carbon;

class DateFilter extends BaseFilter
{
	/* filter properties */
	public function currentValue($new = null)
	{
		if ($new !== null) {
			if (!is_string($new))
				throw new \InvalidArgumentException('Filter value must be null or array.');

			// throws InvalidArgumentException on malformed dates
			Carbon::createFromFormat('d.m.Y', $new);
		}

		return $this->getOrSet('current_value', $new);
	}

	/* filtering */
	public function applyFilter($query)
	{
		$value = Carbon::createFromFormat('d.m.Y', $this->currentValue());

		if (is_string($field_or_callback = $this->fieldOrCallback())) {
			$query->where($field_or_callback, '>=', $value->format('Y-m-d') . ' 00:00:00')
				->where($field_or_callback, '<=', $value->format('Y-m-d') . ' 23:59:59');
		} else {
			$field_or_callback($query, $value);
		}
	}
}
