<?php

if (!elgg_get_plugin_setting('enable_group_map', 'hypeMapsOpen')) {
	throw new \Elgg\PageNotFoundException();
}

$title = elgg_echo('maps:open:countries');

$content = elgg_view('maps/countries');

$layout = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'sidebar' => false,
	'filter_id' => 'groups/all',
	'filter_value' => 'groups:map',
		]);

echo elgg_view_page($title, $layout);
