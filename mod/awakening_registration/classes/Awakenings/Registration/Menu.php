<?php

namespace Awakenings\Registration;

class Menu {
    public function pageMenu(\Elgg\Hook $hook) {
        if (!elgg_in_context('admin') || !elgg_is_admin_logged_in()) {
            return;
        }

        $return = $hook->getValue();

        $return[] = \ElggMenuItem::factory([
            'name' => 'users:reg:step3',
            'text' => elgg_echo('admin:users:reg:step3'),
            'href' => 'admin/users/reg_step3',
            'priority' => 55,
            'section' => 'administer',
            'parent_name' => 'users',
        ]);

        $return[] = \ElggMenuItem::factory([
            'name' => 'users:reg:step5',
            'text' => elgg_echo('admin:users:reg:step5'),
            'href' => 'admin/users/reg_step5',
            'priority' => 56,
            'section' => 'administer',
            'parent_name' => 'users',
        ]);

        return $return;
    }
}