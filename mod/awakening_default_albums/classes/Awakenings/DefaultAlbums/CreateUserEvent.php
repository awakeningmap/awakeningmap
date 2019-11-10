<?php

namespace Awakenings\DefaultAlbums;

use Elgg\HooksRegistrationService\Event;

class CreateUserEvent {

    public function __invoke(Event $hook) {
        $user = $hook->getObject();

		if (!$user instanceof \ElggUser) {
			return;
		}

        $ia = elgg_set_ignore_access(true);

        $albums = ['My Pictures', 'My Video', 'My Music'];

        foreach ($albums as $title) {
            $album = new \hypeJunction\Media\MediaAlbum();
            $album->title = $title;
            $album->container_guid = $user->guid;
            $album->owner_guid = $user->guid;
            $album->access_id = ACCESS_PRIVATE;

            $album->save();
        }

        elgg_set_ignore_access($ia);
	}
}