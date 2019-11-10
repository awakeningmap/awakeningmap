<?php

$entity = elgg_extract('entity', $vars);

echo elgg_view('input/dropzone', array_merge($vars, [
	'multiple' => true,
	'accept' => 'image/*,video/*,audio/*,application/pdf',
	'max' => 100,
	'query' => [
		'album_guid' => $entity->guid,
	],
	'subtype' => 'media_file',
]));