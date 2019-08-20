<?php

namespace Awakenings\Now;

use Elgg\EntityNotFoundException;
use Elgg\Request;

class LeaveNowEvent {

	public function __invoke(Request $request) {
		$entity = $request->getEntityParam();

		if (!$entity instanceof NowEvent) {
			throw new EntityNotFoundException();
		}

		$user = elgg_get_logged_in_user_entity();

		remove_entity_relationship($user->guid, 'join', $entity->guid);

		elgg_delete_river([
			'action_type' => 'join',
			'subject_guid' => $user->guid,
			'object_guid' => $entity->guid,
		]);

		$subject = elgg_echo('now:leave:subject', [$user->getDisplayName(), $entity->location]);
		$message = elgg_echo('now:leave:message', [
			$user->getDisplayName(),
			$entity->getDisplayName(),
			$entity->location,
			elgg_generate_url('add:object:messages', [
				'send_to' => $user->guid,
			]),
		]);

		notify_user($entity->owner_guid, $subject, $message, [
			'event' => 'leave',
			'object' => $entity,
			'subject' => $user,
			'url' => $entity->getURL(),
		]);

		return elgg_ok_response();
	}
}