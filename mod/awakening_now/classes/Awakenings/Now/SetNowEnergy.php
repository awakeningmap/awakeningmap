<?php

namespace Awakenings\Now;

use Elgg\EntityPermissionsException;
use Elgg\Request;

class SetNowEnergy {

	public function __invoke(Request $request) {
		$guid = $request->getParam('guid');

		$entity = get_entity($guid);

		if (!$entity instanceof \ElggEntity || !$entity->canEdit()) {
			throw new EntityPermissionsException();
		}

		$value = $request->getParam('value');

		$entity->energy = (int) $value;

		return elgg_ok_response('');
	}
}