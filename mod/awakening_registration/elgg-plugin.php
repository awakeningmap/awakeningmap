<?php

return [
	'bootstrap' => \Awakenings\Registration\Bootstrap::class,
	'actions' => [
		'registration/image_upload' => [
			'controller' => \Awakenings\Registration\ImageUploadAction::class,
			'access' => 'public',
		],
		'awakening_registration/step3' => [
			'controller' => \Awakenings\Registration\Step3Action::class,
			'access' => 'public'
		],
		'awakening_registration/step5' => [
			'controller' => \Awakenings\Registration\Step5Action::class,
			'access' => 'public'
		]
	],
	'entities' => [
		[
			'type' => 'object',
			'subtype' => 'awakening_reg_image',
			'class' => \Awakenings\Registration\Image::class,
			'searchable' => false,
		],
		[
			'type' => 'object',
			'subtype' => 'awakening_reg_step3',
			'class' => ElggObject::class,
			'searchable' => false
		],
		[
			'type' => 'object',
			'subtype' => 'awakening_reg_step5',
			'class' => ElggObject::class,
			'searchable' => false
		]
	],
	'routes' => [
		"view:register:step3_complete" => [
			'path' => "/awakening/register/step3_complete",
			'resource' => 'awakening/register/step3_complete',
			'middleware' => [ \Elgg\Router\Middleware\LoggedOutGatekeeper::class ]
		],
	]
];
