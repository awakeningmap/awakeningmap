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
}