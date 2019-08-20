<?php

namespace Awakenings\Now;

use Elgg\Hook;

class NowEventNotification {

	public function __invoke(Hook $hook) {
		$event = $hook->getParam('event');
		/* @var \Elgg\Notifications\NotificationEvent $event */

		$notification = $hook->getParam('notification');
		/* @var \Elgg\Notifications\Notification */

		$entity = $event->getObject();
		/* @var \ElggEntity $entity */

		$owner = $event->getActor();
		$language = $hook->getParam('language');

		$notification->subject = elgg_echo('now:notify:subject', [
			$owner->getDisplayName(),
			$entity->location
		], $language);

		$notification->body = elgg_echo('now:notify:body', [
			$owner->getDisplayName(),
			$entity->getDisplayName(),
			$entity->location,
			elgg_view('output/longtext', ['value' => $entity->description]),
			$entity->getURL(),
		], $language);

		$notification->summary = elgg_echo('now:notify:summary', [
			$owner->getDisplayName(),
			$entity->location
		], $language);

		$notification->url = $entity->getURL();

		return $notification;
	}
}