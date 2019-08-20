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

$subject_link = elgg_view('output/url', [
	'class' => 'elgg-river-subject',
	'text' => $subject->getDisplayName(),
	'href' => $subject->getURL(),
]);

$others = elgg_get_entities([
	'relationship' => 'join',
	'relationship_guid' => $object->guid,
	'inverse_relationship' => true,
	'count' => true,
]);

if ($others) {
	$subject_link .= elgg_echo('now:joined:others', [$others]);
}

$object_link = elgg_view('output/url', [
	'class' => 'elgg-river-object',
	'text' => $object->getDisplayName(),
	'href' => $object->getURL(),
]);

$params = $vars;

$params['summary'] = elgg_echo('now:river:summary', [
	$subject_link,
	$object_link,
]);

$params['message'] = elgg_view('output/longtext', ['value' => $object->description]);

$params['attachments'] = elgg_view('object/now_event/map', [
	'entity' => $object,
]);

echo elgg_view('river/elements/layout', $params);
