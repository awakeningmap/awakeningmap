<?php
/**
 * Navigation menu for a user's or a group's pages
 *
 * @uses $vars['page'] Page object if manually setting selected item
 */

use Awakenings\Story\AwakeningStoryField;

/** registration logic */
$get_nav_tree = function($container) {
    if (!$container instanceof ElggEntity) {
		return;
	}

	$top_pages = elgg_get_entities([
		'type' => 'object',
		'subtype' => 'page',
		'container_guid' => $container->guid,
		'limit' => false,
		'batch' => true,
		'metadata_name_value_pairs' => [
			'parent_guid' => 0,
        ],
        'order_by_metadata' => [
            'name' => 'awakening_date',
            'as' => 'integer',
            'direction' => 'ASC',
        ],
	]);

	$tree = [];
	
	$get_children = function($parent_guid, $depth = 0) use (&$tree, &$get_children) {
		$children = new ElggBatch('elgg_get_entities', [
			'type' => 'object',
			'subtype' => 'page',
			'metadata_name_value_pairs' => [
				'parent_guid' => $parent_guid,
			],
			'limit' => false,
		]);
		
		foreach ($children as $child) {
			$tree[] = [
				'guid' => $child->guid,
				'title' => $child->getDisplayName(),
				'url' => $child->getURL(),
				'parent_guid' => $parent_guid,
				'depth' => $depth + 1,
			];
			
			$get_children($child->guid, $depth + 1);
		}
	};
	
	/* @var $page ElggPage */
	foreach ($top_pages as $page) {
		$tree[] = [
			'guid' => $page->guid,
			'title' => $page->getDisplayName(),
			'url' => $page->getURL(),
            'depth' => 0,
            'season-date' => AwakeningStoryField::getStoryDateSeason($page->awakening_date) . ' ' . AwakeningStoryField::getStoryDateYear($page->awakening_date)
		];
		
		$get_children($page->guid);
    }

    $finaltree = [];

    $last_season = '';
    $last_season_key = '';
    foreach ($tree as $key => $t) {
        if ($t['depth']) {
            $t['depth']++;
            $finaltree[] = $t;
            continue;
        }

        if ($t['season-date'] !== $last_season) {
            $last_season = $t['season-date'];
            $last_season_key = 'season-date-' . $key;

            $finaltree[] = [
                'guid' => $last_season_key,
                'title' => $t['season-date'],
                'url' => 'javascript:void(0)',
                'depth' => 0,
                'link_class' => 'nav-season-date'
            ];
        }

        $t['depth']++;
        $t['parent_guid'] = $last_season_key;
        $finaltree[] = $t;
    }

	return $finaltree;
};

$register_nav_tree = function ($container, $selected = null) use ($get_nav_tree) {
	
	$pages = $get_nav_tree($container);
	if (empty($pages)) {
		return;
	}

	foreach ($pages as $page) {
		elgg_register_menu_item('pages_nav', [
			'name' => $page['guid'],
			'text' => $page['title'],
			'href' => $page['url'],
			'parent_name' => elgg_extract('parent_guid', $page),
            'selected' => $selected instanceof ElggPage && $selected->guid === $page['guid'],
            'link_class' => isset($page['link_class']) ? $page['link_class'] : ''
		]);
	}
};

// add the jquery treeview files for navigation
elgg_load_css('jquery.treeview');
elgg_require_js('pages/sidebar/navigation');

$selected_page = elgg_extract('page', $vars, false);

$title = elgg_echo('pages:navigation');

$register_nav_tree(elgg_get_page_owner_entity(), $selected_page);

$content = elgg_view_menu('pages_nav', [
	'class' => 'pages-nav',
]);

if (!$content) {
	$content = elgg_format_element('p', [], elgg_echo('pages:none'));
}

echo elgg_view_module('aside', $title, $content);
