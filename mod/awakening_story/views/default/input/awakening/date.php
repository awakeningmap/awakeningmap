<?php

$value = elgg_extract('value', $vars, time(), false);

$current_year = (int) date('Y');
$year = (int) date('Y', $value);
$month = (int) date('n', $value);

$seasons = [
	'winter' => [12, 1, 2],
	'spring' => [3, 4, 5],
	'summer' => [6, 7, 8],
	'fall' => [9, 10, 11],
];

$get_season = function($month) use ($seasons) {
	foreach ($seasons as $season => $months) {
		if (in_array($month, $months)) {
			return $season;
		}
	}
};

echo elgg_view_field([
	'#type' => 'fieldset',
	'#label' => elgg_echo('awakening:story:date'),
	'class' => 'elgg-row',
	'required' => true,
	'fields' => [
		[
			'#type' => 'select',
			'#class' => 'elgg-col-1of2',
			'name' => 'awakening_date[month]',
			'options' => array_map(function ($e) use ($seasons) {
				return [
					'text' => elgg_echo("awakening:season:$e"),
					'value' => $seasons[$e][1],
				];
			}, array_keys($seasons)),
			'value' => $seasons[$get_season($month)][1],
		],
		[
			'#type' => 'select',
			'#class' => 'elgg-col-1of2',
			'name' => 'awakening_date[year]',
			'options' => range($current_year - 100, $current_year),
			'value' => $year,
		],
	],
]);