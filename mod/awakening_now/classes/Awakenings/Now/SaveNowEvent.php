<?php

namespace Awakenings\Now;

use Elgg\EntityNotFoundException;
use Elgg\EntityPermissionsException;
use Elgg\Request;

class SaveNowEvent {

	public function __invoke(Request $request) {
		$guid = $request->getParam('guid');
		$is_new = false;

		if ($guid) {
			$entity = get_entity($guid);

			if (!$entity instanceof NowEvent) {
				throw new EntityNotFoundException();
			}
		} else {
			$is_new = true;

			$container_guid = $request->getParam('container_guid');
			if (!$container_guid) {
				$container_guid = elgg_get_logged_in_user_guid();
			}

			$container = get_entity($container_guid);

			if (!$container || !$container->canWriteToContainer(0, 'object', NowEvent::SUBTYPE)) {
				throw new EntityPermissionsException();
			}

			$entity = new NowEvent();
			$entity->container_guid = $container->guid;
		}

		$entity->title = elgg_get_title_input();
		$entity->description = $request->getParam('description');
		$entity->access_id = $request->getParam('access_id');
		$entity->location = $request->getParam('location');

		$duration = $request->getParam('duration');
		$entity->duration = $duration;
		$entity->calendar_start = time();
		$entity->calendar_end = strtotime("+${duration} hours", $entity->calendar_start);

		if ($entity->save()) {
			if ($is_new) {
				elgg_create_river_item([
					'action_type' => 'create',
					'object_guid' => $entity->guid,
				]);

				elgg_trigger_event('publish', 'object', $entity);
			}

			return elgg_ok_response('', elgg_echo('now:save:success'), $entity->getURL());
		}

		return elgg_error_response(elgg_echo('now:save:error'));
	}
}