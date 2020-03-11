<?php

return [
	'bootstrap' => \Awakenings\Story\Bootstrap::class,

	'routes' => [
		// 'awakening:story:owner' => [
		// 	'path' => '/awakening/story/{username}',
		// 	'resource' => 'awakening/story/owner',
		// ],
	],
	'actions' => [
		'pages/edit' => [
			'controller' => \Awakenings\Story\SaveStory::class
		],
	],
];
