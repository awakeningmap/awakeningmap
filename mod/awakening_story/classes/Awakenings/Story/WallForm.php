<?php

namespace Awakenings\Story;

use Elgg\Hook;

class WallForm {

	public function __invoke(Hook $hook) {
		$conf = $hook->getValue();

		$entity = elgg_get_page_owner_entity();

		if (!$entity || $entity instanceof \ElggUser) {
			$conf['fields'][] = [
					'#type' => 'awakening/story',
				] + $hook->getParams();
		}

		return $conf;
	}
}