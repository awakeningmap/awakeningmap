<?php
/**
 * Group profile summary
 *
 * Icon and profile fields
 *
 * @uses $vars['entity']
 */

$group = elgg_extract('entity', $vars);
if (!($group instanceof \ElggGroup)) {
	echo elgg_echo('groups:notfound');
	return;
}

$fields_content = elgg_view('groups/profile/fields', $vars);

if ($fields_content) {
    echo elgg_format_element('div', [
        'class' => 'groups-profile-fields',
    ], $fields_content);
}
