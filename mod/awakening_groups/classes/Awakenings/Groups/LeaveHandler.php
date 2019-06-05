<?php

namespace Awakenings\Groups;

use Elgg\HooksRegistrationService\Event;

class LeaveHandler {

	public function __invoke(Event $hook) {
		$params = $hook->getObject();

		$user = elgg_extract('user', $params);
		$group = elgg_extract('group', $params);

		if (!$group instanceof \ElggGroup || !$user instanceof \ElggUser) {
			return;
		}

		$children = elgg_get_entities([
			'types' => 'group',
			'container_guids' => $group->guid,
			'relationship' => 'member',
			'relationship_guid' => $user->guid,
			'inverse_relationship' => false,
			'limit' => 0,
			'batch' => true,
		]);

		foreach ($children as $child) {
			/* @var $child \ElggGroup */
			$child->leave($user);
		}
	}
}