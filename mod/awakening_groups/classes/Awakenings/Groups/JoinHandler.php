<?php

namespace Awakenings\Groups;

use Elgg\HooksRegistrationService\Event;

class JoinHandler {

	public function __invoke(Event $hook) {
		$params = $hook->getObject();

		$user = elgg_extract('user', $params);
		$group = elgg_extract('group', $params);

		if (!$group instanceof \ElggGroup || !$user instanceof \ElggUser) {
			return;
		}

		$parent = $group->getContainerEntity();

		if ($parent instanceof \ElggGroup && !$parent->isMember($user)) {
			$parent->join($user);
		}
	}
}