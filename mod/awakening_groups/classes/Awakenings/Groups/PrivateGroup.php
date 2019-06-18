<?php

namespace Awakenings\Groups;

use hypeJunction\Groups\Group;

class PrivateGroup extends Group {
	const SUBTYPE = 'private';

	public function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}
}