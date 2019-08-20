<?php

echo elgg_view_form('now/save', [
	'enctype' => 'multipart/form-data',
	'class' => [
		'post-form',
		'wall-form',
		elgg_is_active_plugin('hypeLists') ? 'wall-has-lists-api' : '',
	],
	'novalidate' => true,
	'id' => 'wall-form-now',
], $vars);
