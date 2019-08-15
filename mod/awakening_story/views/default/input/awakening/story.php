<?php

$value = elgg_extract('value', $vars, []);

$is_awakening_story = (bool) elgg_extract('is_awakening_story', $value);
$date = elgg_extract('awakening_date', $value);

echo elgg_view_field([
	'#type' => 'checkbox',
	'#label' => elgg_echo('awakening:story:add'),
	'name' => 'is_awakening_story',
	'value' => 1,
	'default' => 0,
	'checked' => $is_awakening_story,
	'switch' => true,
]);


$extra = elgg_view_field([
	'#type' => 'awakening/date',
	'value' => $date,
]);

echo elgg_format_element('div', [
	'class' => [
		'awakening-story-fields',
		$is_awakening_story ? '' : 'hidden',
	],
], $extra);

elgg_require_js('input/awakening/story');