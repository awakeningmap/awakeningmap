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
		'collection:group:country:map' => [
			'path' => '/countries/map',
			'resource' => 'maps/countries',
		],

		"view:group:region" => [
			'path' => "/regions/profile/{guid}/{title?}",
			'resource' => 'regions/profile',
		],
	],

	'widgets' => [
		'activity_group_list' => [
				'context' => ['dashboard'],
		],
	]
];
