<?php

$entity = elgg_extract('entity', $vars);
$date = $entity->awakening_date;

if (!$date) {
	return;
}

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

$month = (int) date('n', $date);
$year = (int) date('Y', $date);

?>

<div class="awakening-story-date">
	<div class="awakening-story-date__season"><?= $get_season($month) ?></div>
	<div class="awakening-story-date__year"><?= $year ?></div>
</div>
