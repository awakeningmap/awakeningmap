<?php

namespace Awakenings\Groups;

class Menus {
    public static function siteMenu($h, $t, $r, $p) {
        foreach ($r as $key => $item) {
            if ($item->getName() === 'countries') {
                $r[$key]->setHref('countries/map');
            }
        }
    }

    public static function groupsFilterMenu($h, $t, $r, $p) {
        if (isset($p['collection'])) {
            $params = $p['collection']->getParams();

            if (strpos($params['_route'], 'group:country') !== false) {
                foreach ($r as $item) {
                    if ($item->getName() === 'groups:map') {
                        $item->setHref('countries/map');

                        if ($p['segments'] && $p['segments'][0] === 'map') {
                            $item->setSelected(true);
                        }
                    }
                }
            }
        }
        else {
            if ($p['filter_id'] == 'groups/all' && $p['identifier'] === 'countries') {
                foreach ($r as $item) {
                    if ($item->getName() === 'groups:map') {
                        $item->setHref('countries/map');

                        if ($p['segments'] && $p['segments'][0] === 'map') {
                            $item->setSelected(true);
                        }
                    }
                }
            }
        }

        return $r;
    }
}