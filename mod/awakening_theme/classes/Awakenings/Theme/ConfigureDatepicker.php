<?php

namespace Awakenings\Theme;
use Elgg\Hook;

class ConfigureDatepicker {
    /**
	 * Configure datepicker
	 *
	 * @param Hook $hook Hook
	 *
	 * @return mixed
	 */
	public function __invoke(Hook $hook) {

		$vars = $hook->getValue();

        $name = (array) elgg_extract('name', $vars);
        $options = (array) elgg_extract('datepicker_options', $vars, []);
        
        if ($name[0] === 'date_of_birth') {
            $start_date = date('Y') - 100;
            $end_date = date('Y') - 13;
            $options['yearRange'] = "{$start_date}:{$end_date}";
        }

        $vars['datepicker_options'] = $options;

		return $vars;

	}
}