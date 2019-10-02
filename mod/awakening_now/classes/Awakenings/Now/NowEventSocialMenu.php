<?php

namespace Awakenings\Now;

class NowEventSocialMenu {

	public function __invoke(\Elgg\Hook $hook) {
		$menu = $hook->getValue();

		$entity = $hook->getEntityParam();

		if (!$entity instanceof NowEvent) {
			return;
		}

		if ($entity->canEdit()) {
			$menu->add(\ElggMenuItem::factory([
				'name' => 'energy',
				'text' => elgg_view('now/energy/input', [
					'entity' => $entity,
				]),
				'href' => false,
			]));
		} else {
			$menu->add(\ElggMenuItem::factory([
				'name' => 'energy',
				'text' => elgg_view('now/energy/output', [
					'entity' => $entity,
				]),
				'href' => false,
			]));
		}
	}
}