define(['elgg', 'jquery'], function(elgg, $) {
    $(document).on('click', '.reg-challenge-value .delete', function() {
        $(this).parents('.reg-challenge-value').first().remove();
    });

    $(document).on('click', '.reg-challenge-wrapper .add', function() {
        var parent = $(this).parents('.reg-challenge-wrapper').first();
        var challenge = parent.find('.reg-challenges');

        if (challenge.val()) {
            var name = $(this).parents('.reg-challenge-wrapper').first().attr('data-name');
            var html = `<div class="reg-challenge-value"><input name="${name}[]" value="${challenge.val()}" type="hidden"><div class="value">${challenge.val()}</div><a href="javascript:void(0)" class="elgg-anchor delete" rel="nofollow"><span class="elgg-anchor-label"><span class="elgg-icon elgg-icon-close fas fa-times"></span></span></a></div>`;

            parent.siblings('.reg-challenge-values').first().append(html);
            challenge.val('');
        }
    });
});