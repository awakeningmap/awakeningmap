<?php

namespace Awakenings\Groups;

use hypeJunction\Groups\DefaultGroupCollection;
use hypeJunction\Lists\Filters\All;
use hypeJunction\Lists\Filters\IsAdministeredBy;
use hypeJunction\Lists\Filters\IsMember;
use hypeJunction\Lists\Sorters\Alpha;
use hypeJunction\Lists\Sorters\MemberCount;
use hypeJunction\Lists\Sorters\TimeCreated;

class AwakeningGroupCollection extends DefaultGroupCollection {

    public function getParams() {
        $params = parent::getParams();

        if (!isset($params['sort'])) {
            $params['sort'] = 'alpha::asc';
        }

        return $params;
    }
	
}