<?php

namespace Awakenings\Story;

use Elgg\Event;
use Elgg\Request;
use hypeJunction\Wall\Post;

class SaveStory {

	// public function __invoke(Event $event) {
	// 	$entity = $event->getObject();

	// 	if (!$entity instanceof Post) {
	// 		return;
	// 	}

	// 	$is_awakening_story = (bool) get_input('is_awakening_story');

	// 	if ($is_awakening_story) {
	// 		$date = get_input('awakening_date');

	// 		if ($date['month'] && $date['year']) {
	// 			$entity->is_awakening_story = true;
	// 			$entity->awakening_date = (new \DateTime())->setDate((int) $date['year'], (int) $date['month'], 15)->getTimestamp();
	// 		}
	// 	} else {
	// 		unset($entity->is_awakening_story);
	// 		unset($entity->awakening_date);
	// 	}
	// }


	public function __invoke(Request $request) {
		elgg_make_sticky_form('page');

		$title = elgg_get_title_input();

		if (!$title) {
			return elgg_error_response('Title is required');
		}

		$date = $request->getParam('awakening_date');

		// Get guids
		$page_guid = (int) $request->getParam('page_guid');
		$container_guid = (int) $request->getParam('container_guid');
		$parent_guid = (int) $request->getParam('parent_guid');

		$awakening_date = null;

		if (!$parent_guid) {
			if (!is_array($date)) {
				return elgg_error_response('Invalid awakening date');
			}

			if (isset($date['month']) && isset($date['year'])) {
				try {
					$awakening_date = (new \DateTime())->setDate((int) $date['year'], (int) $date['month'], 15)->getTimestamp();
				} catch (\Exception $e) {
					return elgg_error_response('Invalid awakening date');
				}
			}
			else {
				return elgg_error_response('Invalid awakening date');
			}
		}

		if ($page_guid) {
			$page = get_entity($page_guid);
			if (!$page instanceof \ElggPage || !$page->canEdit()) {
				return elgg_error_response(elgg_echo('pages:cantedit'));
			}
			$new_page = false;
		} else {
			$page = new \ElggPage();
			$page->container_guid = $container_guid;
			$new_page = true;
		}

		$can_change_access = true;

		if ($page->getOwnerEntity()) {
			$can_change_access = $page->getOwnerEntity()->canEdit();
		}

		$page->title = $title;
		$page->description = $request->getParam('description');
		$page->awakening_date = $awakening_date;
		$page->tags = string_to_tag_array($request->getParam('tags'));
		$page->comments_on = $request->getParam('comments_on');
		$page->activity_entry = $request->getParam('activity_entry');

		if ($can_change_access) {
			$page->access_id = $request->getParam('access_id');
			$page->write_access_id = $request->getParam('write_access_id');
		}

		if (!$new_page && $parent_guid && $parent_guid !== $page_guid) {
			// Check if parent isn't below the page in the tree
			$tree_page = get_entity($parent_guid);
			while ($tree_page instanceof \ElggPage && $page_guid !== $tree_page->guid) {
				$tree_page = $tree_page->getParentEntity();
			}
			// If is below, bring all child elements forward
			if ($page_guid === $tree_page->guid) {
				$previous_parent = $page->getParentGUID();

				$children = elgg_get_entities([
					'type' => 'object',
					'subtype' => 'page',
					'metadata_name_value_pairs' => [
						'parent_guid' => $page->guid,
					],
					'limit' => false,
					'batch' => true,
					'batch_inc_offset' => false,
				]);
				
				/* @var $child ElggPage */
				foreach ($children as $child) {
					$child->setParentByGUID($previous_parent);
				}
			}
		}

		// set parent
		$page->setParentByGUID($parent_guid);

		if (!$page->save()) {
			return elgg_error_response(elgg_echo('pages:notsaved'));
		}

		elgg_clear_sticky_form('page');

		// Now save description as an annotation
		$page->annotate('page', $page->description, $page->access_id);

		if ($new_page && (int) $page->activity_entry) {
			elgg_create_river_item([
				'action_type' => 'create',
				'object_guid' => $page->guid,
			]);
		}

		return elgg_ok_response('', elgg_echo('pages:saved'), $page->getURL());
	}
}