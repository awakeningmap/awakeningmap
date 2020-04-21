<?php

namespace Awakenings\Events;

class Permissions {
    public static function canCreateEvent($user = null) {
        if (!elgg_is_logged_in()) {
            return false;
        }

        if (!$user) {
            $user = elgg_get_logged_in_user_entity();
        }

        return $user->isAdmin();
    }
}