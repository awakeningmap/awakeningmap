<?php

echo elgg_view('page/components/map', [
	'src' => elgg_generate_url('collection:group:country:map', [
		'view' => 'json',
	]),
	'show_search' => true,
	'zoom' => 4,
	'layer_options' => [
		'minZoom' => 3,
	],
]);
