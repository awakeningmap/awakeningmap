<?php
/**
 * Display user's pages
 *
 * Note: this view has a corresponding view in the rss view type, changes should be reflected
 *
 * @uses $vars['entity'] the user
 */

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof ElggEntity) {
	return;
}

echo elgg_list_entities([
	'type' => 'object',
	'subtype' => 'page',
    'metadata_name_value_pairs' => [
        [
            'name' => 'parent_guid',
            'value' => 0
        ]
	],
	'order_by_metadata' => [
		'name' => 'awakening_date',
		'as' => 'integer',
		'direction' => 'ASC',
	],
	'owner_guid' => $entity->guid,
	'no_results' => elgg_echo('pages:none'),
]);
