<?php

namespace App\Support\ListingFilter\Filters;

use Carbon\Carbon;

class DateRangeFilter extends BaseRangeFilter
{
	/* filter properties */
	public function currentValue($new = null)
	{
		if ($new !== null) {
			if (!is_array($new))
				throw new \InvalidArgumentException('Filter value must be null or array.');

			if (!isset($new[0]) && !isset($new[1]))
				throw new InvalidArgumentException('Filter value elements 0 or 1 must be set.');

			// Carbon throws InvalidArgumentException on malformed dates
			if (isset($new[0]))
				Carbon::createFromFormat('d.m.Y', $new[0]);

			if (isset($new[1]))
				Carbon::createFromFormat('d.m.Y', $new[1]);
		}

		return $this->getOrSet('current_value', $new);
	}

	/* filtering */
	public function applyFilter($query)
	{
		$from = $this->currentValue()[0] ?? null;
		$to = $this->currentValue()[1] ?? null;

		if ($from !== null)
			$from = Carbon::createFromFormat('d.m.Y', $from);

		if ($to !== null)
			$to = Carbon::createFromFormat('d.m.Y', $to);

		if (is_string($field_or_callback = $this->fieldOrCallback())) {
			if ($from !== null)
				$query->where($field_or_callback, '>=', $from->format('Y-m-d') . ' 00:00:00');

			if ($to !== null)
				$query->where($field_or_callback, '<=', $to->format('Y-m-d') . ' 23:59:59');
		} else {
			$field_or_callback($query, $from, $to);
		}
	}
}
