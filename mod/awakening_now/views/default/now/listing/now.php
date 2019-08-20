<?php

echo elgg_view('page/components/map', [
	'src' => elgg_generate_url('collection:object:now_event:map', [
		'view' => 'json',
	]),
	'show_search' => true,
	'zoom' => 10,
	'layer_options' => [
		'minZoom' => 5,
	],
]);
