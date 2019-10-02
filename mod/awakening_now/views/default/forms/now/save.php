<?php

echo elgg_view_field([
	'#type' => 'text',
	'#label' => elgg_echo('now:title'),
	'#help' => elgg_echo('now:title:help'),
	'name' => 'title',
	'value' => $entity->title,
	'required' => true,
]);

echo elgg_view_field([
	'#type' => 'longtext',
	'#label' => elgg_echo('description'),
	'name' => 'description',
	'value' => $entity->description,
	'required' => true,
]);

echo elgg_view_field([
	'#type' => 'location',
	'#label' => elgg_echo('now:location'),
	'name' => 'location',
	'value' => $entity->location,
	'required' => true,
]);

echo elgg_view_field([
	'#type' => 'number',
	'#label' => elgg_echo('now:duration'),
	'#help' => elgg_echo('now:duration:help'),
	'name' => 'duration',
	'value' => $entity->duration ? : 1,
	'required' => true,
]);

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'guid',
	'value' => $entity->guid,
]);

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'container_guid',
	'value' => $entity->container_guid ? : elgg_get_logged_in_user_guid(),
]);

$footer = elgg_view_field([
	'#type' => 'fieldset',
	'align' => 'horizontal',
	'justify' => 'right',
	'class' => 'wall-footer-controls',
	'fields' => [
		[
			'#type' => 'access',
			'name' => 'access_id',
			'value' => $entity->access_id ?? ACCESS_PUBLIC,
			'required' => true,
		],
		[
			'#type' => 'submit',
			'value' => elgg_echo('save'),
		],
	],
]);

elgg_set_form_footer($footer);
