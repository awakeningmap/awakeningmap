<?php

$entity = elgg_extract('entity', $vars);
$date = $entity->awakening_date;

if (!$date) {
	return;
}
?>

<div class="awakening-story-date">
	<div class="awakening-story-date__season"><?= \Awakenings\Story\AwakeningStoryField::getStoryDateSeason($date) ?></div>
	<div class="awakening-story-date__year"><?= \Awakenings\Story\AwakeningStoryField::getStoryDateYear($date) ?></div>
</div>
