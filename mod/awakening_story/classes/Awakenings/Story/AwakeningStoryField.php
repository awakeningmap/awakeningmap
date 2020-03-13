<?php

namespace Awakenings\Story;

use Elgg\Request;
use ElggEntity;
use hypeJunction\Fields\Field;
use Symfony\Component\HttpFoundation\ParameterBag;

class AwakeningStoryField extends Field {

	public function raw(Request $request, ElggEntity $entity) {
		return [
			'is_awakening_story' => (bool) $request->getParam('is_awakening_story'),
			'awakening_date' => $request->getParam('awakening_date'),
		];
	}

	public function save(ElggEntity $entity, ParameterBag $parameters) {
		$value = $parameters->get($this->name);

		$is_awakening_story = elgg_extract('is_awakening_story', $value);

		if ($is_awakening_story) {
			$date = elgg_extract('awakening_date', $value);

			if ($date['month'] && $date['year']) {
				$entity->is_awakening_story = true;
				$entity->awakening_date = (new \DateTime())->setDate((int) $date['year'], (int) $date['month'], 15)->getTimestamp();
			}
		} else {
			unset($entity->is_awakening_story);
			unset($entity->awakening_date);
		}
	}

	public function retrieve(ElggEntity $entity) {
		return [
			'is_awakening_story' => $entity->is_awakening_story,
			'awakening_date' => $entity->awakening_date,
		];
	}

	public static function getStoryDateSeason($date) {
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

		return $get_season($month);
	}

	public static function getStoryDateYear($date) {
		return (int) date('Y', $date);
	}
}