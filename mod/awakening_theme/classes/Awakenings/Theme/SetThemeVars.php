<?php

namespace Awakenings\Theme;

use Elgg\Hook;

class SetThemeVars {

	public function __invoke(Hook $hook) {

		$vars = $hook->getValue();

		return [
			// layout and shell
			'body-background-color' => '#fbfbfb',

			// Typography
			'font-size' => '16px', // global font size
			'font-bold-weight' => '500', // weight of <strong> and <b> elements
			'font-family' => '"Quicksand", "Helvetica Neue", Helvetica, Arial, sans-serif', // global font family

			'anchor-color' => '#2771aa',
			'anchor-color-hover' => '#1f5885',

			'h-font-family' => '"Quicksand", "Helvetica Neue", Helvetica, Arial, sans-serif',
			'h-font-weight' => 'normal',
			'h1-font-size' => '1.8rem',
			'h2-font-size' => '1.5rem',
			'h3-font-size' => '1.2rem',
			'h4-font-size' => '1.0rem',
			'h5-font-size' => '0.9rem',
			'h6-font-size' => '0.8rem',


			// element colors
			'text-color-soft' => '#7c8b96',
			'text-color-mild' => '#5d6870',
			'text-color-strong' => '#1f2225',
			'text-color-highlight' => '#2771aa',

			'background-color-soft' => '#fcfcfc',
			'background-color-mild' => '#eaeaea',
			'background-color-strong' => '#f8f7f7',
			'background-color-highlight' => '#2771aa',

			'border-color-soft' => '#dcdcdc',
			'border-color-mild' => '#dcdcdc',
			'border-color-strong' => '#b9c6d0',
			'border-color-highlight' => '#2771aa',

			// messages and notices
			'state-success-font-color' => '#397f2e',
			'state-success-background-color' => '#eaf8e8',
			'state-success-border-color' => '#aadea2',

			'state-danger-font-color' => '#b94a48',
			'state-danger-background-color' => '#f8e8e8',
			'state-danger-border-color' => '#e5b7b5',

			'state-notice-font-color' => '#3b8bc9',
			'state-notice-background-color' => '#e7f1f9',
			'state-notice-border-color' => '#b1d1e9',

			'state-warning-font-color' => '#6b420f',
			'state-warning-background-color' => '#fcf8e4',
			'state-warning-border-color' => '#eddc7d',

			// buttons
			'button-submit-background-color' => '#2771aa',
			'button-submit-font-color' => '#ffffff',
			'button-submit-background-color-hover' => '#1f5885',
			'button-submit-font-color-hover' => '#ffffff',

			'button-action-background-color' => '#2771aa',
			'button-action-font-color' => '#ffffff',
			'button-action-background-color-hover' => '#1f5885',
			'button-action-font-color-hover' => '#ffffff',

			'button-cancel-background-color' => '#e6e6ea',
			'button-cancel-font-color' => '#2d3047',
			'button-cancel-background-color-hover' => '#cfcfd2',
			'button-cancel-font-color-hover' => '#2d3047',

			'button-delete-background-color' => '#e6e6ea',
			'button-delete-font-color' => '#2d3047',
			'button-delete-background-color-hover' => '#d33f49',
			'button-delete-font-color-hover' => '#ffffff',

			// topbar
			'topbar-background-color' => '#2771aa',
			'topbar-indicator' => '#aa274e',

			// breakpoints
			'tablet' => '50rem',
			'desktop' => '80rem',
			'media-tablet-up' => 'screen and (min-width: 50rem)',
			'media-desktop-up' => 'screen and (min-width: 80rem)',
			'media-mobile-only' => 'screen and (max-width: 50rem)',
			'media-desktop-down' => 'screen and (max-width: 80rem)',
			'media-tablet-only' => 'screen and (min-width: 50rem) and (max-width: 80rem)',

			'border-radius' => '4px',

			'shadow-s' => '0 2px 4px rgba(0,0,0,.1), 0 2px 4px rgba(0, 0, 0, 0.1)',
		];
	}
}