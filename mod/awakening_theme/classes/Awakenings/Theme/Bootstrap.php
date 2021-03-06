<?php

namespace Awakenings\Theme;

use Elgg\PluginBootstrap;
use hypeJunction\Capabilities\Role;
use hypeJunction\Capabilities\Roles;
use hypeJunction\Groups\GroupsService;
use hypeJunction\Wall\Menus as WallMenus;

class Bootstrap extends PluginBootstrap {

	/**
	 * Executed during 'plugins_load', 'system' event
	 *
	 * Allows the plugin to require additional files, as well as configure services prior to booting the plugin
	 *
	 * @return void
	 */
	public function load() {
		// TODO: Implement load() method.
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
		elgg_unregister_event_handler('init', 'system', '_profile_fields_setup');
	}

	/**
	 * Executed during 'init', 'system' event
	 *
	 * Allows the plugin to implement business logic and register all other handlers
	 *
	 * @return void
	 */
	public function init() {
		elgg_extend_view('elgg.css', 'awakenings/theme.css');

		$hooks = $this->elgg()->hooks;
		$hooks->registerHandler('view_vars', 'input/date', ConfigureDatepicker::class, 1000);
		$hooks->registerHandler('vars:compiler', 'css', SetThemeVars::class, 800);
		$hooks->registerHandler('register', 'menu:embed', [Menus::class, 'embedMenu'], 1000);
		$hooks->unregisterHandler('register', 'menu:site', 'ColdTrick\TranslationEditor\SiteMenu::register');
	}

	/**
	 * Executed during 'ready', 'system' event
	 *
	 * Allows the plugin to implement logic after all plugins are initialized
	 *
	 * @return void
	 */
	public function ready() {
		// remove the "add content" from wall form
		elgg_unregister_plugin_hook_handler('register', 'menu:wall:quick_links', [WallMenus::class, 'setupQuickLinks']);
	}

	/**
	 * Executed during 'shutdown', 'system' event
	 *
	 * Allows the plugin to implement logic during shutdown
	 *
	 * @return void
	 */
	public function shutdown() {
		// TODO: Implement shutdown() method.
	}

	/**
	 * Executed when plugin is activated, after 'activate', 'plugin' event and before activate.php is included
	 *
	 * @return void
	 */
	public function activate() {
		// TODO: Implement activate() method.
	}

	/**
	 * Executed when plugin is deactivated, after 'deactivate', 'plugin' event and before deactivate.php is included
	 *
	 * @return void
	 */
	public function deactivate() {
		// TODO: Implement deactivate() method.
	}

	/**
	 * Registered as handler for 'upgrade', 'system' event
	 *
	 * Allows the plugin to implement logic during system upgrade
	 *
	 * @return void
	 */
	public function upgrade() {
		// TODO: Implement upgrade() method.
	}
}