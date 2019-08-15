<?php

namespace Awakenings\Story;

use Elgg\Hook;

class OwnerBlockMenu {

	public function __invoke(Hook $hook) {
		$menu = $hook->getValue();
		$entity = $hook->getEntityParam();
		if (!$entity instanceof \ElggUser) {
			return;
		}

		$menu->add(\ElggMenuItem::factory([
			'name' => 'awakening_story',
			'text' => elgg_echo('awakening:story'),
			'href' => elgg_generate_url('awakening:story:owner', [
				'username' => $entity->username,
			]),
		]));
	}
}