<?php

$guid = elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', \Awakenings\Now\NowEvent::SUBTYPE);

$entity = get_entity($guid);

elgg_push_entity_breadcrumbs($entity, false);

$title = $entity->getDisplayName();

$content = elgg_view_entity($entity, [
	'full_view' => true,
	'show_responses' => true,
]);

$layout = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'filter_id' => 'now/view',
	'entity' => $entity,
]);

echo elgg_view_page($title, $layout, 'default', [
	'entity' => $entity,
]);
