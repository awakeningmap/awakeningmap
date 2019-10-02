<?php

$user = elgg_get_page_owner_entity();
if (!$user instanceof ElggUser) {
	return;
}

$title = elgg_echo('awakening:story:owner', [$user->getDisplayName()]);

elgg_push_breadcrumb($user->getDisplayName(), $user->getURL());
elgg_push_breadcrumb($title);

$layout = elgg_view_layout('default', [
	'title' => $title,
	'content' => elgg_view('awakening/story', [
		'entity' => $user,
	]),
]);

echo elgg_view_page($title, $layout);