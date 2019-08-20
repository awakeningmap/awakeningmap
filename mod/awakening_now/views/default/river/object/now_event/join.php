<?php

$item = elgg_extract('item', $vars);
if (!$item instanceof ElggRiverItem) {
	return;
}

$object = $item->getObjectEntity();
if (!$object instanceof \Awakenings\Now\NowEvent) {
	return;
}

$subject = $item->getSubjectEntity();
if (!$subject instanceof ElggUser) {
	return;
}

$other_subject = $object->getOwnerEntity();

$subject_link = elgg_view('output/url', [
	'class' => 'elgg-river-subject',
	'text' => $subject->getDisplayName(),
	'href' => $subject->getURL(),
]);

$other_subject_link = elgg_view('output/url', [
	'class' => 'elgg-river-subject',
	'text' => $other_subject->getDisplayName(),
	'href' => $other_subject->getURL(),
]);

$object_link = elgg_view('output/url', [
	'class' => 'elgg-river-object',
	'text' => $object->getDisplayName(),
	'href' => $object->getURL(),
]);

$params = $vars;

$params['summary'] = elgg_echo('now:river:join:summary', [
	$subject_link,
	$object_link,
	$other_subject_link,
]);

$params['message'] = elgg_view('output/longtext', ['value' => $object->description]);

$marker = \hypeJunction\MapsOpen\Marker::fromLocation($object->location);
$marker->icon = 'far fa-clock';
$marker->title = $object->getDisplayName();
$marker->tooltip = $object->location;

$params['attachments'] = elgg_view('object/now_event/map', [
	'entity' => $object,
]);


echo elgg_view('river/elements/layout', $params);
