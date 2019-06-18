<?php

namespace Awakenings\Groups;

use Elgg\PluginBootstrap;
use hypeJunction\Capabilities\Context;
use hypeJunction\Capabilities\Role;
use hypeJunction\Capabilities\Roles;
use hypeJunction\Groups\GroupsService;
use hypeJunction\MapsOpen\Post;

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
		// TODO: Implement boot() method.
	}

	/**
	 * Executed during 'init', 'system' event
	 *
	 * Allows the plugin to implement business logic and register all other handlers
	 *
	 * @return void
	 */
	public function init() {
		GroupsService::instance()->unregisterSubtype('group');

		GroupsService::instance()->registerSubtype('topic', [
			'labels' => [
				'en' => [
					'item' => 'Topic',
					'collection' => 'Topics',
				],
			],
			'root' => true,
			'identifier' => 'topics',
			'class' => Topic::class,
			'site_menu' => true,
		]);

		GroupsService::instance()->registerSubtype('country', [
			'labels' => [
				'en' => [
					'item' => 'Country',
					'collection' => 'Countries',
				],
			],
			'root' => true,
			'identifier' => 'countries',
			'class' => Country::class,
			'site_menu' => true,
			'tools' => ['wall', 'activity'],
			'preset_tools' => true,
		]);

		GroupsService::instance()->registerSubtype('region', [
			'labels' => [
				'en' => [
					'item' => 'Regional Group',
					'collection' => 'Regional Groups',
				],
			],
			'root' => false,
			'parents' => ['country'],
			'identifier' => 'regions',
			'class' => RegionalGroup::class,
			'site_menu' => false,
		]);

		GroupsService::instance()->registerSubtype('private', [
			'labels' => [
				'en' => [
					'item' => 'Private Group',
					'collection' => 'Private Groups',
				],
			],
			'root' => true,
			'identifier' => 'private_groups',
			'class' => PrivateGroup::class,
			'site_menu' => true,
		]);

		Roles::instance()->admin->onCreate('group', 'group', Role::DENY);
		Roles::instance()->admin->onUpdate('group', 'group', Role::DENY);

		Roles::instance()->user->onCreate('group', 'group', Role::DENY);
		Roles::instance()->user->onCreate('group', 'country', Role::DENY);

		Roles::instance()->user->onCreate('group', 'region', Role::DENY, function(Context $context) {
			$user = $context->getActor();
			if (!$user) {
				return Role::DENY;
			}

			return 0 === elgg_get_entities([
				'count' => true,
				'types' => 'group',
				'subtypes' => 'region',
				'owner_guids' => $user->guid,
			]);
		});

		Roles::instance()->user->onCreate('group', 'topic', Role::ALLOW);

		Roles::instance()->user->onCreate('group', 'private', Role::DENY, function(Context $context) {
			$user = $context->getActor();
			if (!$user) {
				return Role::DENY;
			}

			return 0 === elgg_get_entities([
				'count' => true,
				'types' => 'group',
				'subtypes' => 'private',
				'owner_guids' => $user->guid,
			]);
		});

		elgg_register_event_handler('join', 'group', JoinHandler::class);
		elgg_register_event_handler('leave', 'group', LeaveHandler::class);

		elgg_register_event_handler('create', 'user', UserRegisteredHandler::class);

		elgg_extend_view('elgg.css', 'awakenings/groups.css');
	}

	/**
	 * Executed during 'ready', 'system' event
	 *
	 * Allows the plugin to implement logic after all plugins are initialized
	 *
	 * @return void
	 */
	public function ready() {
		elgg_unregister_plugin_hook_handler('modules', 'group', [Post::class, 'addLocationModule']);
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