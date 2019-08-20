<?php

namespace Awakenings\Now;

class NowEventMenu {

	public function __invoke(\Elgg\Hook $hook) {
		$menu = $hook->getValue();

		$entity = $hook->getEntityParam();

		if (!$entity instanceof NowEvent) {
			return;
		}

		if ($this->canJoin($entity)) {
			$has_joined = $this->hasJoined($entity);

			$menu->add(\ElggMenuItem::factory([
				'name' => 'now:join',
				'href' => elgg_generate_action_url('now/join', [
					'guid' => $entity->guid,
				]),
				'is_action' => true,
				'text' => elgg_echo('now:join'),
				'icon' => 'fas fa-street-view',
				'data-toggle' => 'now:leave',
				'item_class' => $has_joined ? 'hidden' : '',
			]));

			$menu->add(\ElggMenuItem::factory([
				'name' => 'now:leave',
				'href' => elgg_generate_action_url('now/leave', [
					'guid' => $entity->guid,
				]),
				'is_action' => true,
				'text' => elgg_echo('now:leave'),
				'icon' => 'fas fa-street-view',
				'data-toggle' => 'now:join',
				'item_class' => $has_joined ? '' : 'hidden',
			]));
		}
	}

	public function hasJoined($entity) {
		$viewer = elgg_get_logged_in_user_entity();

		if (check_entity_relationship($viewer->guid, 'join', $entity->guid)) {
			return true;
		}

		return false;
	}

	public function canJoin($entity) {
		$viewer = elgg_get_logged_in_user_entity();

		if ($entity->owner_guid == $viewer->guid) {
			return false;
		}

		return true;
	}

}