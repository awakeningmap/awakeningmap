define(function (require) {
	var elgg = require('elgg');
	var $ = require('jquery');
	var Ajax = require('elgg/Ajax');

	$(document).on('click', '.now-energy-item', function (e) {
		e.preventDefault();

		var $elem = $(this);

		$elem.siblings().removeClass('elgg-state-selected');
		$elem.addClass('elgg-state-selected');

		var ajax = new Ajax(false);

		ajax.action('now/set_energy', {
			data: $elem.data()
		});
	})
});