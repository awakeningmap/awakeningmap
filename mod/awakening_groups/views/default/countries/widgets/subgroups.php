<?php

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \Awakenings\Groups\Country) {
	return;
}

$list = elgg_list_entities([
	'types' => 'group',
	'container_guids' => $entity->guid,
	'limit' => 20,
	'no_results' => elgg_echo('collection:group:region:no_results'),
]);

$items = [];

if ($entity->canWriteToContainer(0, 'group', 'region')) {
	$items[] = ElggMenuItem::factory([
		'name' => 'add:region',
		'text' => elgg_echo('add:group:region'),
		'href' => elgg_generate_url('add:group:region', [
			'container_guid' => $entity->guid,
		]),
		'icon' => 'plus',
	]);
}

$menu = elgg_view_menu('country', [
	'items' => $items,
]);

echo elgg_view_module('info', elgg_echo('collection:group:region'), $list, [
	'menu' => $menu,
	'class' => 'awakening-subgroups-module elgg-module-group',
]);