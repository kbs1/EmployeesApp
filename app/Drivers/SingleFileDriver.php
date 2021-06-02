<?php

namespace App\Drivers;

use Orbit\Contracts\Driver;
use Orbit\Facades\Orbit;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class SingleFileDriver implements Driver
{
	public function shouldRestoreCache(string $directory): bool
	{
		return filemtime($this->filePath($directory)) > filemtime(Orbit::getDatabasePath());
	}

	public function save(Model $model, string $directory): bool
	{
		$file = $this->filePath($directory);
		$models = $this->load($file);

		$keyName = $model->getKeyName();
		$originalKeyValue = $model->getOriginal($keyName);

		foreach ($models as $i => $m) {
			if ($m[$keyName] == $originalKeyValue) {
				unset($models[$i]);
				break;
			}
		}

		$models[] = $model->attributesToArray();
		$models = array_values($models);

		if (!file_exists($file)) {
			file_put_contents($file, '');
		}

		return $this->store($file, $models);
	}

	public function delete(Model $model, string $directory): bool
	{
		$file = $this->filePath($directory);
		$models = $this->load($file);

		$keyName = $model->getKeyName();
		$keyValue = $model->getKey();

		foreach ($models as $i => $m) {
			if ($m[$keyName] === $keyValue) {
				unset($models[$i]);
				break;
			}
		}

		$models = array_values($models);

		return $this->store($file, $models);
	}

	public function all(string $directory): Collection
	{
		return collect($this->load($this->filePath($directory)));
	}

	protected function filePath(string $directory)
	{
		$path = $directory . DIRECTORY_SEPARATOR . basename($directory) . '.' . $this->extension();

		if (!file_exists($path))
			touch($path);

		return $path;
	}

	abstract protected function extension(): string;
	abstract protected function load(string $file): array;
	abstract protected function store(string $file, array $models): bool;
}