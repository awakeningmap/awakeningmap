<?php

$entity = elgg_extract('entity', $vars);

if (!$entity) {
	return;
}

elgg_require_js('now/energy/input');

$items = [
	[
		'icon' => elgg_get_simplecache_url('now/icons/bolt-red.svg'),
		'selected' => $entity->energy === -1,
        'value' => -1,
	],
	[
		'icon' => elgg_get_simplecache_url('now/icons/bolt-grey.svg'),
		'selected' => !$entity->energy,
		'value' => 0,
	],
	[
		'icon' => elgg_get_simplecache_url('now/icons/bolt-green.svg'),
		'selected' => $entity->energy === 1,
		'value' => 1,
	],
];
?>

<div class="now-energy">
	<?php
	foreach ($items as $item) {
		echo elgg_format_element('div', [
			'class' => [
				'now-energy-item',
				$item['selected'] ? 'elgg-state-selected' : '',
			],
            'data-value' => $item['value'],
            'data-guid' => $entity->guid,
		], elgg_view('output/img', [
			'src' => $item['icon'],
		]));
	}
	?>
</div>

