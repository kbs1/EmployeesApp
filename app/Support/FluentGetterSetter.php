<?php

namespace App\Support;

trait FluentGetterSetter
{
	protected function getOrSet(string $property, $new = null)
	{
		if ($new === null)
			return $this->$property;

		$this->$property = $new;

		return $this;
	}
}
