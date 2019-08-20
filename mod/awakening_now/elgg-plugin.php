<?php

return [
	'bootstrap' => \Awakenings\Now\Bootstrap::class,

	'entities' => [
		[
			'type' => 'object',
			'subtype' => 'now_event',
			'class' => \Awakenings\Now\NowEvent::class,
		],
	],

	'actions' => [
		'now/save' => [
			'access' => 'logged_in',
			'controller' => \Awakenings\Now\SaveNowEvent::class,
		],
		'now/join' => [
			'access' => 'logged_in',
			'controller' => \Awakenings\Now\JoinNowEvent::class,
		],
		'now/leave' => [
			'access' => 'logged_in',
			'controller' => \Awakenings\Now\LeaveNowEvent::class,
		],
	],

	'routes' => [
		'view:object:now_event' => [
			'path' => '/now/view/{guid}',
			'resource' => 'now/view',
		],
		'collection:object:now_event:default' => [
			'path' => '/now/all',
			'resource' => 'now/all',
		],
		'collection:object:now_event:map' => [
			'path' => '/now/map',
			'resource' => 'now/map',
		],
	]
];
