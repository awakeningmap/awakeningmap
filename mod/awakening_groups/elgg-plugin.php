<?php

return [
	'bootstrap' => \Awakenings\Groups\Bootstrap::class,

	'upgrades' => [
		\Awakenings\Upgrades\ImportCountries::class,
	],

	'routes' => [
		"view:group:country" => [
			'path' => "/countries/profile/{guid}/{title?}",
			'resource' => 'countries/profile',
		],

		"view:group:region" => [
			'path' => "/regions/profile/{guid}/{title?}",
			'resource' => 'regions/profile',
		],
	]
];
