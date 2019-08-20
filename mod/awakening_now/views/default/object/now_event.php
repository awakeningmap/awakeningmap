<?php

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \Awakenings\Now\NowEvent) {
	return;
}

$vars['imprint'] = [
	[
		'icon_name' => 'far fa-clock',
		'content' => elgg_echo('now:expires', [elgg_get_friendly_time($entity->calendar_end)]),
		'class' => 'elgg-listing-expiry',
	],
	[
		'icon_name' => 'fas fa-map-marker',
		'content' => $entity->location,
		'class' => 'elgg-listing-location',
	],
];

if (elgg_extract('full_view', $vars)) {
	$body = elgg_view('output/longtext', [
		'value' => $entity->description,
		'class' => 'now-event-description mbl',
	]);

	$participants = elgg_view('object/now_event/participants', [
		'entity' => $entity,
		'module' => true,
	]);

	$map = elgg_view('object/now_event/map', [
		'entity' => $entity,
		'module' => true,
	]);

	$params = [
		'icon' => true,
		'body' => $body,
		'show_summary' => true,
		'show_navigation' => true,
		'attachments' => $participants . $map,
	];
	$params = $params + $vars;

	echo elgg_view('object/elements/full', $params);
} else {
	// brief view
	$params = [
		'content' => $body,
		'icon' => true,
	];

	$params = $params + $vars;
	echo elgg_view('object/elements/summary', $params);
}
