<?php

$entity = elgg_extract('entity', $vars);

echo elgg_view_field([
	'#type' => 'plaintext',
	'#label' => elgg_echo('awakening_groups:topic_categories'),
	'#help' => elgg_echo('awakening_groups:topic_categories:help'),
	'name' => 'params[topic_categories]',
	'value' => $entity->topic_categories,
]);