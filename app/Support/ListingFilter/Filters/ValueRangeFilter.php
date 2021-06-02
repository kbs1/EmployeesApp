<?php

namespace App\Support\ListingFilter\Filters;

use App\Support\ListingFilter\Column;
use App\Support\FluentGetterSetter;

class ValueRangeFilter extends BaseRangeFilter
{
	use FluentGetterSetter;

	protected $min, $max, $step = 1;

	/* filter properties */
	public function min(float $new = null)
	{
		return $this->getOrSet('min', $new);
	}

	public function max(float $new = null)
	{
		return $this->getOrSet('max', $new);
	}

	public function step(float $new = null)
	{
		return $this->getOrSet('step', $new);
	}

	/* filtering */
	public function applyFilter($query)
	{
		$from = $this->currentValue()[0] ?? null;
		$to = $this->currentValue()[1] ?? null;

		if ($from !== null)
			$from = str_replace(',', '.', $from);

		if ($to !== null)
			$to = str_replace(',', '.', $to);

		if (is_string($field_or_callback = $this->fieldOrCallback())) {
			if ($from !== null)
				$query->where($field_or_callback, '>=', $from);

			if ($to !== null)
				$query->where($field_or_callback, '<=', $to);
		} else {
			$field_or_callback($query, $from, $to);
		}
	}
}
