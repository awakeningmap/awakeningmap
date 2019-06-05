<?php

namespace Awakenings\Groups;

use hypeJunction\Groups\Group;

class Country extends Group {
	const SUBTYPE = 'country';

	public function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}
}