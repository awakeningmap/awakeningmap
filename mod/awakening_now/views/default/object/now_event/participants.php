<?php

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \Awakenings\Now\NowEvent) {
	return;
}

$participants = elgg_list_entities([
	'relationship' => 'join',
	'relationship_guid' => $entity->guid,
	'inverse_relationship' => true,
	'full_view' => false,
	'pagination' => true,
	'pagination_type' => 'infinite',
	'offset_key' => 'participants',
	'no_results' => elgg_echo('now:participants:no_results'),
]);

if (!$participants) {
	return;
}

if (elgg_extract('module', $vars)) {
	echo elgg_view_module('aside', elgg_echo('now:participants'), $participants);
} else {
	echo $participants;
}
