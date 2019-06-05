<?php

namespace Awakenings\Groups;

use hypeJunction\Groups\Group;

class Topic extends Group {
	const SUBTYPE = 'topic';

	public function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}
}