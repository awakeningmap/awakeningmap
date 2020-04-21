<?php
/**
 * Page edit form body
 */

$fields = elgg_get_config('pages');

if (empty($fields)) {
	return;
}

$entity = elgg_extract('entity', $vars);
$parent_guid = elgg_extract('parent_guid', $vars);

$can_change_access = true;
if ($entity instanceof ElggPage && $entity->getOwnerEntity()) {
	$can_change_access = $entity->getOwnerEntity()->canEdit();
}

echo elgg_view_field([
    'name' => 'title',
    'value' => $vars['title'],
    '#type' => 'text',
    '#label' => elgg_echo("pages:title"),
    'required' => true
]);

echo elgg_view_field([
    'name' => 'description',
    'value' => $vars['description'],
    '#type' => 'longtext',
    '#label' => elgg_echo('pages:description')
]);

if (!$parent_guid) {
    echo elgg_view_field([
        'name' => 'awakening_date',
        'value' => $vars['awakening_date'],
        '#type' => 'awakening/date',
        '#label' => ''
    ]);
}

echo elgg_view_field([
    'name' => 'tags',
    'value' => $vars['tags'],
    '#type' => 'tags',
    '#label' => elgg_echo('pages:tags')
]);

if ($parent_guid) {
    echo elgg_view_field([
        'name' => 'parent_guid',
        'value' => $vars['parent_guid'],
        '#type' => 'pages/parent',
        '#label' => elgg_echo("pages:pages/parent"),
        'entity' => $entity
    ]);
}

if ($can_change_access) {
    echo elgg_view_field([
        'name' => 'access_id',
        'value' => $vars['access_id'],
        '#type' => 'access',
        '#label' => elgg_echo('pages:access_id'),
        'entity' => $entity,
        'entity_type' => 'object',
        'entity_subtype' => 'page'
    ]);

    echo elgg_view_field([
        'name' => 'write_access_id',
        'value' => $vars['write_access_id'],
        '#type' => 'access',
        '#label' => elgg_echo('pages:write_access_id'),
        'entity' => $entity,
        'entity_type' => 'object',
        'entity_subtype' => 'page',
        'purpose' => 'write',
        'entity_allows_comments' => false
    ]);

    echo elgg_view_field([
        'name' => 'comments_on',
        'value' => 1,
        '#type' => 'checkbox',
        '#label' => elgg_echo('pages:comments_on'),
        'switch' => true,
        'checked' => (bool) $vars['comments_on']
    ]);

    echo elgg_view_field([
        'name' => 'activity_entry',
        'value' => 1,
        '#type' => 'checkbox',
        '#label' => elgg_echo('pages:activity_entry'),
        'switch' => true,
        'checked' => (bool) $vars['activity_entry']
    ]);
}

if ($entity instanceof ElggPage) {
	echo elgg_view_field([
		'#type' => 'hidden',
		'name' => 'page_guid',
		'value' => $entity->guid,
	]);
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'container_guid',
	'value' => elgg_extract('container_guid', $vars),
]);

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);
elgg_set_form_footer($footer);
