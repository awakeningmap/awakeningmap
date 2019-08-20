<?php

namespace Awakenings\Now;

use Elgg\PluginBootstrap;

class Bootstrap extends PluginBootstrap {

	/**
	 * Executed during 'plugins_load', 'system' event
	 *
	 * Allows the plugin to require additional files, as well as configure services prior to booting the plugin
	 *
	 * @return void
	 */
	public function load() {

	}

	/**
	 * Executed during 'plugins_boot:before', 'system' event
	 *
	 * Allows the plugin to register handlers for 'plugins_boot', 'system' and 'init', 'system' events,
	 * as well as implement boot time logic
	 *
	 * @return void
	 */
	public function boot() {

	}

	/**
	 * Executed during 'init', 'system' event
	 *
	 * Allows the plugin to implement business logic and register all other handlers
	 *
	 * @return void
	 */
	public function init() {
		if (elgg_is_logged_in()) {
			elgg_register_menu_item('site', [
				'name' => 'now',
				'text' => elgg_echo('now'),
				'href' => elgg_generate_url('collection:object:now_event:default'),
			]);
		}

		elgg_register_plugin_hook_handler('tabs', 'wall', WallTabs::class);

		elgg_register_notification_event('object', NowEvent::SUBTYPE, ['publish']);
		elgg_register_plugin_hook_handler('prepare', 'notification:publish:object:now_event', NowEventNotification::class);

		elgg_register_plugin_hook_handler('get', 'subscriptions', NowEventSubscribers::class);

		elgg_register_plugin_hook_handler('register', 'menu:entity', NowEventMenu::class);
		elgg_register_plugin_hook_handler('register', 'menu:river', NowRiverEventMenu::class);
		elgg_register_plugin_hook_handler('register', 'menu:title', NowTitleEventMenu::class);

		elgg_register_plugin_hook_handler('cron', 'halfhour', DisableExpiredEvents::class, 300);
	}

	/**
	 * Executed during 'ready', 'system' event
	 *
	 * Allows the plugin to implement logic after all plugins are initialized
	 *
	 * @return void
	 */
	public function ready() {

	}

	/**
	 * Executed during 'shutdown', 'system' event
	 *
	 * Allows the plugin to implement logic during shutdown
	 *
	 * @return void
	 */
	public function shutdown() {

	}

	/**
	 * Executed when plugin is activated, after 'activate', 'plugin' event and before activate.php is included
	 *
	 * @return void
	 */
	public function activate() {

	}

	/**
	 * Executed when plugin is deactivated, after 'deactivate', 'plugin' event and before deactivate.php is included
	 *
	 * @return void
	 */
	public function deactivate() {

	}

	/**
	 * Registered as handler for 'upgrade', 'system' event
	 *
	 * Allows the plugin to implement logic during system upgrade
	 *
	 * @return void
	 */
	public function upgrade() {

	}
}