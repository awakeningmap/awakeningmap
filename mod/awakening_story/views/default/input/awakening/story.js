define(function(require) {
	var elgg = require('elgg');
	var $ = require('jquery');

	$(document).on('change', '[name="is_awakening_story"]', function(e) {
		var $el = $(this);

		console.log($el, $el.is(':checked'));

		if ($el.is(':checked')) {
			$el.closest('form').find('.awakening-story-fields').removeClass('hidden');
		} else {
			$el.closest('form').find('.awakening-story-fields').addClass('hidden');
		}
	});
});