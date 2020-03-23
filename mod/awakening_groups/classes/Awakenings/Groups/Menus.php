<?php

namespace Awakenings\Groups;

class Menus {
    public static function siteMenu($h, $t, $r, $p) {
        foreach ($r as $key => $item) {
            if ($item->getName() === 'countries') {
                // $r[$key]->setHref('countries/map');
            }
        }
    }
}