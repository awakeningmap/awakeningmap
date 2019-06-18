<?php

namespace Awakenings\Groups;

use Elgg\HooksRegistrationService\Event;

class UserRegisteredHandler {

	public function __invoke(Event $hook) {
		$user = $hook->getObject();

		if (!$user) {
			return;
		}

		elgg_call(ELGG_IGNORE_ACCESS, function() use ($user) {
			$group = new PrivateGroup();
			$group->container_guid = $user->guid;
			$group->owner_guid = $user->guid;
			$group->name = "{$user->name}'s Group";
			$group->location = $user->location;
			$group->access_id = ACCESS_PRIVATE;
			$group->membership = ACCESS_PRIVATE;
			$group->setContentAccessMode(\ElggGroup::CONTENT_ACCESS_MODE_MEMBERS_ONLY);

			if ($group->save()) {
				$group->join($user);
			}
		});
	}
}