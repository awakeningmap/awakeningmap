<?php

namespace Awakenings\Now;

use Elgg\Hook;

class WallTabs {

	public function __invoke(Hook $hook) {
		$value = $hook->getValue();

		$vars = $hook->getParams();

		$tabs = $value['tabs'];

		$quick_links = array_pop($tabs);

		$tabs['now'] = [
			'text' => elgg_echo('now:create'),
			'icon' => 'far fa-clock',
			'selected' => get_input('wall_tab', 'status') === 'now',
			'content' => elgg_view('now/now', $vars),
		];

		$tabs['quick_links'] = $quick_links;

		$value['tabs'] = $tabs;

		return $value;
	}
}