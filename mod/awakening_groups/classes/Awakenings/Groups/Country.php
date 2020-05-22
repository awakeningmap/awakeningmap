<?php

namespace Awakenings\Groups;

use hypeJunction\Groups\Group;

class Country extends Group {
	const SUBTYPE = 'country';

	public function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}

	public static function afterCreate($hook, $type, $return, $params) {
		$group = $params['entity'];
		$site = elgg_get_site_entity();

		$ia = elgg_set_ignore_access(true);

		$should_resave = false;
		
		if ($group->owner_guid !== $site->guid) {
			$group->owner_guid = $site->guid;
			$should_resave = true;
		}

		if ($group->getContainerEntity() instanceof \ElggUser) {
			$group->container_guid = $site->guid;
			$should_resave = true;
		}

		if ($should_resave) {
			$group->save();
		}

		elgg_set_ignore_access($ia);

		return $return;
	}
}