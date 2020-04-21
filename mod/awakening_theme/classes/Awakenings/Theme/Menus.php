<?php

namespace Awakenings\Theme;

class Menus {
    public static function embedMenu($h, $t, $r, $p) {
        $remove = ['file', 'posts', 'assets', 'buttons', 'code', 'map'];

        $removekeys = [];
        foreach ($r as $key => $item) {
            if (in_array($item->getName(), $remove)) {
                $removekeys[] = $key;
            }
        }

        foreach ($removekeys as $k) {
            unset($r[$k]);
        }

        return array_values($r);
    }
}