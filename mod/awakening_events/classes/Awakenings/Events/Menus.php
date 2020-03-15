<?php

namespace Awakenings\Events;

class Menus {
    public static function ownerBlockLinks($hook, $type, $return, $params) {
        foreach ($return as $key => $item) {
            if ($item->getName() == 'events' && $params['entity'] instanceof \ElggUser) {
                $return[$key]->setHref('/event/upcoming');
            }

            if ($item->getName() == 'events' && $params['entity'] instanceof \ElggGroup) {
                unset($return[$key]);
            }
        }

        return array_values($return);
    }

    public static function eventsFilter($hook, $type, $return, $params) {
        foreach ($return as $key => $item) {
            if ($item->getName() == 'mine' && !Permissions::canCreateEvent()) {
                unset($return[$key]);
            }
        }

        return array_values($return);
    }

    // public static function siteMenu($hook, $type, $return, $params) {
    //     foreach ($return as $key => $item) {
    //         if ($item->getName() === 'event') {
    //             // unset($return[$key]);
    //         }
    //     }

    //     return array_values($return);
    // }
}