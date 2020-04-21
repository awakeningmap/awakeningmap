<?php

namespace Awakenings\Registration;

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

	}

	/**
	 * Executed during 'init', 'system' event
	 *
	 * Allows the plugin to implement business logic and register all other handlers
	 *
	 * @return void
	 */
	public function init() {
		elgg_extend_view('elgg.css', 'awakening/registration.css');

		// remove cover image input from users
		$this->elgg()->hooks->registerHandler('uses:cover', 'user:user', [\Elgg\Values::class, 'getFalse']);
        
        elgg_register_ajax_view('awakening/registration/step1');
        elgg_register_ajax_view('awakening/registration/step2');
		elgg_register_ajax_view('awakening/registration/step3');
		elgg_register_ajax_view('awakening/registration/step4');
		elgg_register_ajax_view('awakening/registration/step5');
		elgg_register_ajax_view('awakening/registration/step6');

		elgg_register_plugin_hook_handler('register', 'menu:page', [Menu::class, 'pageMenu']);

		elgg_register_plugin_hook_handler('field_types', 'post', ConfigureFieldTypes::class);
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