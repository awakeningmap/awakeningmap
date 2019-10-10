<?php

namespace Awakenings\Groups;

use Elgg\HooksRegistrationService\Hook;

class SetupGroupModules {
    function __invoke(Hook $hook)
    {
        $entity = $hook->getEntityParam();
		if (!$entity instanceof \ElggGroup) {
			return;
		}

        $modules = $hook->getValue();
        
        foreach ($modules as $key => $val) {
            if ($val['view'] === 'groups/sidebar/admins' && $val['position'] == 'sidebar') {
                unset($modules[$key]);
            }
        }
        return $modules;
    }
}