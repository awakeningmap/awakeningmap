<?php

$col1 = elgg_list_entities([
	'types' => 'object',
	'subtypes' => \Awakenings\Now\NowEvent::SUBTYPE,
	'no_results' => elgg_echo('now:no_results'),
]);

$col2 = elgg_view('page/components/map', [
	'src' => elgg_generate_url('collection:object:now_event:map', [
		'view' => 'json',
	]),
	'show_search' => false,
	'zoom' => 10,
	'layer_options' => [
		'minZoom' => 5,
	],
]);

?>

<div class="elgg-grid">
	<div class="elgg-col elgg-col-1of2"><?= $col1 ?></div>
	<div class="elgg-col elgg-col-1of2"><?= $col2 ?></div>
</div>
