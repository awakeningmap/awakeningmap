<?php

$entity = elgg_extract('entity', $vars);

echo elgg_list_entities([
	'types' => 'object',
	'owner_guids' => (int) $entity->guid,
	'metadata_name_value_pairs' => [
		[
			'name' => 'is_awakening_story',
			'value' => true,
		],
	],
	'order_by_metadata' => [
		'name' => 'awakening_date',
		'as' => 'integer',
		'direction' => 'ASC',
	],
	'full_view' => false,
	'item_view' => 'awakening/story/item',
	'list_class' => 'awakening-story-list',
	'no_results' => elgg_echo('awakening:story:no_results'),
]);