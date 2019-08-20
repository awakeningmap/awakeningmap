<?php

namespace Awakenings\Now;

class NowEvent extends \ElggObject {

	const SUBTYPE = 'now_event';

	public function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
	}

}