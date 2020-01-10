<?php

$request = elgg_extract('request', $vars);
/* @var $request \Elgg\Request */

$subtype = elgg_extract('subtype', $vars, 'user');
$constructor = elgg_get_entity_class('user', $subtype);
if (!$constructor || !is_subclass_of($constructor, ElggUser::class)) {
	$constructor = ElggUser::class;
}

$title = elgg_echo('register');
if (elgg_language_key_exists("register:$subtype")) {
	$title = elgg_echo("register:$subtype");
}

$content = elgg_view('awakening/registration');

if (elgg_is_xhr()) {
	echo $content;
	return;
}

if (elgg_is_active_plugin('hypeTheme')) {
	$shell = 'walled_garden';
} else {
	$shell = elgg_get_config('walled_garden') ? 'walled_garden' : 'default';
}

$body = elgg_view_layout('default', [
	'content' => $content,
	'title' => $title,
	'sidebar' => false,
]);

echo elgg_view_page($title, $body, $shell, [
	'class' => 'elgg-page-register',
]);
