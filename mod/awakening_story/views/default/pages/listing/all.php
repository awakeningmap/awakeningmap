<?php
/**
 * Display pages
 *
 * Note: this view has a corresponding view in the rss view type, changes should be reflected
 */

echo elgg_list_entities([
	'type' => 'object',
	'subtype' => 'page',
	'metadata_name_value_pairs' => [
		'parent_guid' => 0,
    ],
    'order_by_metadata' => [
		'name' => 'awakening_date',
		'as' => 'integer',
		'direction' => 'ASC',
	],
	'no_results' => elgg_echo('pages:none'),
]);
