<?php

namespace Awakenings\Theme;

use Elgg\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use hypeJunction\Landing\SaveLandingDataAction as hypeLandingDataAction;

class SaveLandingDataAction extends hypeLandingDataAction {

	public function __invoke(Request $request) {


		$config = [];

		$blocks = $request->getParam('blocks', [], false);
		$uploads = elgg_get_uploaded_files('blocks');

		foreach ($blocks as $i => $block) {
			$type = elgg_extract('type', $block);
			$block_config = false;

			switch ($type) {
				case 'hero' :
					$block_config = $this->saveHero($block, elgg_extract($i, $uploads, []));
					break;

				case 'features' :
					$block_config = $this->saveFeatures($block, elgg_extract($i, $uploads, []));
					break;

				case 'slides' :
					$block_config = $this->saveSlides($block, elgg_extract($i, $uploads, []));
					break;

				case 'htmlblock':
					$block_config = $this->saveHtmlblock($block);
					break;
			}

			if ($block_config !== false) {
				$block_config['disabled'] = $block['disabled'] ? 1 : 0;
				$config[] = $block_config;
			}
		}

		elgg_save_config('landing.blocks', $config);

		elgg_flush_caches();

        return elgg_ok_response($config, elgg_echo('admin:theme:landing:success'));
	}

	public function saveHtmlblock(array $input = []) {
		$config = [
			'type' => 'htmlblock'
		];

		$config['data'] = elgg_extract('data', $input);

		return $config;
	}

	public function saveHero(array $input = [], array $files = []) {
		$config = [
			'type' => 'hero',
		];

		$props = [
			'heading' => 'text',
			'tagline' => 'text',
			'img' => 'file',
			'bg' => 'file',
			'disable_bg' => 'text',
			'disable_content' => 'text',
			'disable_logo' => 'text'
		];

		foreach ($props as $prop => $type) {
			switch ($type) {
				case 'text' :
					$config['data'][$prop] = elgg_extract($prop, $input);
					break;

				case 'file' :
					$file = elgg_extract($prop, $files);
					$view = $this->saveFile($file);
					if ($view) {
						$config['data'][$prop] = $view;
					} else {
						$config['data'][$prop] = elgg_extract($prop, $input);
					}
					break;
			}
		}

		return $config;
	}
	
	public function saveFeature(array $input = [], array $files = []) {
		$props = [
			'title' => 'text',
			'description' => 'text',
			'img' => 'file',
			'disable_feature' => 'text',
			'disable_img' => 'text',
			'disable_title' => 'text',
			'disable_description' => 'text'
		];

		foreach ($props as $prop => $type) {
			switch ($type) {
				case 'text' :
					$config[$prop] = elgg_extract($prop, $input);
					break;

				case 'file' :
					$file = elgg_extract($prop, $files);
					$view = $this->saveFile($file);
					if ($view) {
						$config[$prop] = $view;
					} else {
						$config[$prop] = elgg_extract($prop, $input);
					}
					break;
			}
		}

		return $config;
	}
    
    public function saveSlide(array $input = [], array $files = []) {
		$props = [
			'title' => 'text',
			'description' => 'text',
            'img' => 'file',
			'disabled' => 'text',
			'disable_image' => 'text',
			'disable_content' => 'text'
		];

		foreach ($props as $prop => $type) {
			switch ($type) {
				case 'text' :
					$config[$prop] = elgg_extract($prop, $input);
					break;

				case 'file' :
					$file = elgg_extract($prop, $files);
					$view = $this->saveFile($file);
					if ($view) {
						$config[$prop] = $view;
					} else {
						$config[$prop] = elgg_extract($prop, $input);
					}
					break;
			}
		}

		return $config;
	}

	public function saveSlides(array $input = [], array $files = []) {
		$config = [
			'type' => 'slides',
		];

		$items = elgg_extract('items', $input, []);

		foreach ($items as $key => $item) {
			$slide_files = isset($files['items'][$key]) ? $files['items'][$key] : [];
			$config['data']['items'][] = $this->saveSlide($item, $slide_files);
		}

		if (isset($input['config']) && is_array($input['config'])) {
			$config['config'] = elgg_extract('config', $input);
		}

		return $config;
	}
}