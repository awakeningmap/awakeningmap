<?php

namespace Awakenings\Groups;

use hypeJunction\Groups\Group;

class RegionalGroup extends Group {
	const SUBTYPE = 'region';

	public function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}
}