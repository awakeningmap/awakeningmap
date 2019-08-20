<?php

elgg_push_collection_breadcrumbs('object', \Awakenings\Now\NowEvent::SUBTYPE);

$title = elgg_echo('now');
$content = elgg_view('now/listing/now');

$layout = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'filter' => false,
]);

echo elgg_view_page($title, $layout);
