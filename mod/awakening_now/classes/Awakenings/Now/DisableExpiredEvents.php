<?php

namespace Awakenings\Now;

use Elgg\Hook;

class DisableExpiredEvents {

	public function __invoke(Hook $hook) {
		dump($hook);

		elgg_call(ELGG_IGNORE_ACCESS, function() {
			$events = elgg_get_entities([
				'types' => 'object',
				'subtypes' => NowEvent::SUBTYPE,
				'metadata_name_value_pairs' => [
					[
						'name' => 'calendar_end',
						'value' => time(),
						'operand' => '<=',
						'type' => ELGG_VALUE_INTEGER,
					],
				],
				'limit' => 0,
				'batch' => true,
			]);

			foreach ($events as $event) {
				$event->disable();
			}
		});
	}
}