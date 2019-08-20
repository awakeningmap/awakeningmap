<?php

namespace Awakenings\Now;

use Elgg\EntityNotFoundException;
use Elgg\Request;

class JoinNowEvent {

	public function __invoke(Request $request) {
		$entity = $request->getEntityParam();

		if (!$entity instanceof NowEvent) {
			throw new EntityNotFoundException();
		}

		$user = elgg_get_logged_in_user_entity();

		add_entity_relationship($user->guid, 'join', $entity->guid);

		elgg_create_river_item([
			'action_type' => 'join',
			'subject_guid' => $user->guid,
			'object_guid' => $entity->guid,
		]);

		$subject = elgg_echo('now:join:subject', [$user->getDisplayName(), $entity->location]);
		$message = elgg_echo('now:join:message', [
			$user->getDisplayName(),
			$entity->getDisplayName(),
			$entity->location,
			elgg_generate_url('add:object:messages', [
				'send_to' => $user->guid,
			]),
		]);

		notify_user($entity->owner_guid, $subject, $message, [
			'event' => 'join',
			'object' => $entity,
			'subject' => $user,
			'url' => $entity->getURL(),
		]);

		return elgg_ok_response();
	}
}