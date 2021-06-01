<?php

return [

	'default' => env('ORBIT_DEFAULT_DRIVER', 'xml'),

	'drivers' => [
		'md' => \Orbit\Drivers\Markdown::class,
		'json' => \Orbit\Drivers\Json::class,
		'yaml' => \Orbit\Drivers\Yaml::class,
		'md_json' => \Orbit\Drivers\MarkdownJson::class,
		'xml' => \App\Drivers\Xml::class,
	],

	'paths' => [
		'content' => storage_path('database'),
		'cache' => storage_path('framework/cache/orbit'),
	],

	'git' => [
		'enabled' => env('ORBIT_GIT_ENABLED', false),
		'name' => env('ORBIT_GIT_NAME'),
		'email' => env('ORBIT_GIT_EMAIL'),
		'root' => env('ORBIT_GIT_ROOT', base_path()),
		'binary' => env('ORBIT_GIT_BINARY', '/usr/bin/git'),
	],

];
