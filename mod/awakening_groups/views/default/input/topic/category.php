<?php

$value = elgg_extract('value', $vars);

$categories = elgg_get_plugin_setting('topic_categories', 'awakening_groups');
$categories = preg_split('/$\R?^/m', $categories);
$categories = array_filter($categories);

$categories = array_map(function($e) {
	return [
		'text' => $e,
		'value' => $e,
	];
}, $categories);

array_unshift($categories, [
	'text' => 'Select...',
	'selected' => !$value,
	'disabled' => true,
]);

$vars['options'] = $categories;

echo elgg_view('input/select', $vars);