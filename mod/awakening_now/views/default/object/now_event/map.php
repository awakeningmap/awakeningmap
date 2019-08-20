<?php

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \Awakenings\Now\NowEvent) {
	return;
}

$marker = \hypeJunction\MapsOpen\Marker::fromLocation($entity->location);
$marker->icon = 'far fa-clock';
$marker->title = $entity->getDisplayName();
$marker->tooltip = $entity->location;

$map = elgg_view('page/components/map', [
	'markers' => [$marker],
	'center' => \hypeJunction\MapsOpen\LatLong::fromLocation($entity->location),
]);

if (elgg_extract('module', $vars)) {
	echo elgg_view_module('aside', elgg_echo('now:map'), $map);
} else {
	echo $map;
}