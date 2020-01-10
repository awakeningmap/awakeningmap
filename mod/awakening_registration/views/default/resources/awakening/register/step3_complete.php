<?php


if (elgg_is_active_plugin('hypeTheme')) {
	$shell = 'walled_garden';
} else {
	$shell = elgg_get_config('walled_garden') ? 'walled_garden' : 'default';
}

$body = elgg_view_layout('default', [
	'content' => '<h1 style="text-align: center; padding-top: 50px;">Thank you for your interest, an administrator will review your information and be in touch</h1>',
	'title' => false,
	'sidebar' => false,
]);

echo elgg_view_page($title, $body, $shell, [
	'class' => 'elgg-page-register',
]);