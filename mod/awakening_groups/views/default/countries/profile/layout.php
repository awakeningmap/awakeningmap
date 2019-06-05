<?php
/**
 * Layout of the groups profile page
 *
 * @uses $vars['entity']
 */

$group = elgg_extract('entity', $vars);

if (!$group instanceof \Awakenings\Groups\Country) {
	return;
}

if ($group->canAccessContent()) {
	if (!$group->isPublicMembership() && !$group->isMember()) {
		echo elgg_view('groups/profile/closed_membership');
	}
} else {
	if ($group->isPublicMembership()) {
		echo elgg_view('groups/profile/membersonly_open');
	} else {
		echo elgg_view('groups/profile/membersonly_closed');
	}
}

echo elgg_view('groups/profile/summary', $vars);

echo elgg_view('countries/widgets/subgroups', $vars);