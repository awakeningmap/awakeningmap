<?php

$entity = elgg_extract('entity', $vars);

$options = [
	'full_view' => false,
	'icon' => false,
	'subtitle' => false,
];

if (!$entity->title) {
	$options['title'] = false;
}

$story = elgg_view_entity($entity, $options);

$story_block = elgg_format_element('div', [
	'class' => 'awakening-story-block',
], $story);

$story_icon = elgg_format_element('div', [
	'class' => 'awakening-story-icon',
], elgg_view('awakening/story/date', $vars));

echo elgg_view_image_block($story_icon, $story_block, [
	'class' => 'awakening-story',
]);