<?php

$entity = elgg_extract('entity', $vars);

if (!$entity) {
	return;
}

switch ($entity->energy) {
	case -1 :
		$icon = elgg_get_simplecache_url('now/icons/bolt-red.svg');
		break;

	case 1 :
		$icon = elgg_get_simplecache_url('now/icons/bolt-green.svg');
		break;

	default :
		$icon = elgg_get_simplecache_url('now/icons/bolt-grey.svg');
		break;
}

echo elgg_view('output/img', [
	'src' => $icon,
]);