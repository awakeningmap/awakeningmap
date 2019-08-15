<?php

namespace Awakenings\Story;

use Elgg\Event;
use hypeJunction\Wall\Post;

class SaveStory {

	public function __invoke(Event $event) {
		$entity = $event->getObject();

		if (!$entity instanceof Post) {
			return;
		}

		$is_awakening_story = (bool) get_input('is_awakening_story');

		if ($is_awakening_story) {
			$date = get_input('awakening_date');

			if ($date['month'] && $date['year']) {
				$entity->is_awakening_story = true;
				$entity->awakening_date = (new \DateTime())->setDate((int) $date['year'], (int) $date['month'], 15)->getTimestamp();
			}
		} else {
			unset($entity->is_awakening_story);
			unset($entity->awakening_date);
		}
	}
}