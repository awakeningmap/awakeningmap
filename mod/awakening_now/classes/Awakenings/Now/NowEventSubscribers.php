<?php

namespace Awakenings\Now;

use Elgg\Hook;
use hypeJunction\MapsOpen\LatLong;

class NowEventSubscribers {

	const SEARCH_RADIUS = 20000;

	public function __invoke(Hook $hook) {
		$event = $hook->getParam('event');
		$subscriptions = $hook->getValue();

		if (!$event instanceof \Elgg\Notifications\SubscriptionNotificationEvent) {
			return;
		}

		if ($event->getAction() !== 'publish') {
			return;
		}

		$entity = $event->getObject();
		if (!$entity instanceof NowEvent) {
			return;
		}

		$owner = $event->getActor();

		$maps_service = elgg()->maps;
		/* @var \hypeJunction\MapsOpen\MapsService $maps_service */

		$options = [
			'types' => 'user',
			'limit' => 0,
			'batch' => true,
		];

		$location = LatLong::fromLocation($entity->location);

		$options = $maps_service->addLocationSearchClauses($options, $location, self::SEARCH_RADIUS);

		$users = elgg_get_entities($options);

		foreach ($users as $user) {
			/* @var \ElggUser $user */

			if (!isset($subscriptions[$user->guid])) {
				$subscriptions[$user->guid] = array_keys(array_filter($user->getNotificationSettings()));
			}
		}

		return $subscriptions;
	}
}