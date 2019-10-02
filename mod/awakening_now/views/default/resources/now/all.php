<?php

elgg_push_collection_breadcrumbs('object', \Awakenings\Now\NowEvent::SUBTYPE);

if (elgg_is_admin_logged_in()) {
	elgg_register_menu_item('title', [
		'name' => 'add',
		'text' => elgg_echo('now:add'),
		'icon' => 'fas fa-clock',
		'link_class' => 'elgg-lightbox elgg-button elgg-button-action',
		'data-colorbox-opts' => json_encode([
			'href' => 'ajax/view/now/now',
			'maxWidth' => '600px',
		]),
	]);
}

$title = elgg_echo('now');
$content = elgg_view('now/listing/now');

$layout = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'filter' => false,
	'sidebar' => false,
]);

echo elgg_view_page($title, $layout);
