<?php

namespace Awakenings\Groups;

use hypeJunction\Fields\FieldInterface;
use hypeJunction\Fields\MetaField;

class SetupTopicFields {

	public function __invoke(\Elgg\Hook $hook) {
		$fields = $hook->getValue();

		$fields->add('category', new MetaField([
			'type' => 'topic/category',
			'is_profile_field' => false,
			'is_search_field' => true,
			'required' => true,
			'priority' => 20,
			'#help' => function () {
				$admins = elgg_get_admins([
					'limit' => 1,
					'order_by' => 'e.time_created ASC',
					'callback' => false,
				]);

				return elgg_echo('field:group:topic:category:help', [
					elgg_view('output/url', [
						'target' => '_blank',
						'text' => elgg_echo('field:group:topic:category:request'),
						'href' => elgg_generate_url('add:object:messages', [
							'send_to' => $admins[0]->guid,
						]),
					])
				]);
			},
		]));

		return $fields;
	}
}