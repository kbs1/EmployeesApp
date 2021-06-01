<?php

namespace App\Drivers;

use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Str;
use SimpleXMLElement;

class Xml extends SingleFileDriver
{
	protected function load(string $file): array
	{
		$contents = file_get_contents($file);

		if (!$contents) {
			return [];
		}

		/* Couldn't find a parser that would work for our XML structure (pretty root / entry names) in all cases,
		 * so we have to roll our own.
		 * - https://github.com/mtownsend5512/xml-to-array returns different structures when only one entry is present vs many
		 * - https://github.com/vyuldashev/xml-to-array crashes when only one entry is present
		*/

		$result = [];
		$entries = new SimpleXMLElement($contents);

		foreach ($entries as $entry) {
			$result[] = (array) $entry;
		}

		return $result;
	}

	protected function store(string $file, array $models): bool
	{
		$entryName = $this->entryName($file);

		// see https://github.com/spatie/array-to-xml#using-custom-keys
		foreach ($models as $index => $model) {
			$models["__custom:$entryName:$index"] = $model;
			unset($models[$index]);
		}

		file_put_contents($file, (new ArrayToXml($models, $this->rootName($file)))->prettify()->toXml());
		return true;
	}

	protected function rootName(string $file): string
	{
		return basename($file, '.' . $this->extension());
	}

	protected function entryName(string $file): string
	{
		return Str::singular($this->rootName($file));
	}

	protected function extension(): string
	{
		return 'xml';
	}
}
