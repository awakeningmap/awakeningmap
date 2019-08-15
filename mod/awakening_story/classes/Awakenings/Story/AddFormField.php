<?php

namespace Awakenings\Story;

use Elgg\Hook;
use InvalidParameterException;

class AddFormField {

	/**
	 * Add slug field
	 *
	 * @param Hook $hook Hook
	 *
	 * @return mixed
	 * @throws InvalidParameterException
	 */
	public function __invoke(Hook $hook) {

		$fields = $hook->getValue();
		/* @var $fields \hypeJunction\Fields\Collection */

		$fields->add('awakening_story', new AwakeningStoryField([
			'type' => 'awakening/story',
			'section' => 'sidebar',
			'priority' => 600,
			'is_profile_field' => false,
		]));

		return $fields;
	}
}
