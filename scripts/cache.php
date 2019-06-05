<?php

require_once dirname(dirname(__FILE__)) . "/vendor/autoload.php";

\Elgg\Application::start();

$view_list = _elgg_services()->views->listViews();

$get_processed_view = function($view, $viewtype) {
	elgg_set_viewtype($viewtype);

	if ($viewtype === 'default' && preg_match("#^languages/(.*?)\\.js$#", $view, $matches)) {
		$view = "languages.js";
		$vars = ['language' => $matches[1]];
	} else {
		$vars = [];
	}

	$content = elgg_view($view, $vars);

	$get_view_file_type = function($view) {
		if (preg_match('~(?:^|/)(css|js)(?:$|/)~', $view, $m)) {
			return $m[1];
		}

		return 'unknown';
	};

	$hook_type = $get_view_file_type($view);
	$hook_params = array(
		'view' => $view,
		'viewtype' => $viewtype,
		'view_content' => $content,
	);

	return \_elgg_services()->hooks->trigger('simplecache:generate', $hook_type, $hook_params, $content);
};

$cache_view = function($view) use ($get_processed_view) {
	$viewtype = 'default';

	$lastcache = elgg_get_config('lastcache');
	$filename = elgg_get_cache_path() . "views_simplecache/$lastcache/$viewtype/$view";

	$content = $get_processed_view($view, $viewtype);

	$dir_name = dirname($filename);
	if (!is_dir($dir_name)) {
		// PHP and the server accessing the cache symlink may be a different user. And here
		// it's safe to make everything readable anyway.
		mkdir($dir_name, 0775, true);
	}

	file_put_contents($filename, $content);

	chmod($filename, 0664);
};

try {
	foreach ($view_list as $view) {
		// Generate a full static view cache
		if (_elgg_services()->views->isCacheableView($view)) {
			$cache_view($view);
		}
	}
} catch (Exception $ex) {
	elgg()->logger->error($ex);
}

error_log('Cache has been rebuilt');
