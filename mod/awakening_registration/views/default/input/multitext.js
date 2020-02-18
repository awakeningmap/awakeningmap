define(['elgg', 'jquery'], function(elgg, $) {
    $(document).on('click', '.multitext-value .delete', function() {
        $(this).parents('.multitext-value').first().remove();
    });

    $(document).on('click', '.multitext-wrapper .add', function() {
        var parent = $(this).parents('.multitext-wrapper').first();
        var input = parent.find('.input-multitext');

        if (input.val()) {
            var name = $(this).parents('.multitext-wrapper').first().attr('data-name');
            var html = `<div class="multitext-value"><input name="${name}[]" value="${input.val()}" type="hidden"><div class="value">${input.val()}</div><a href="javascript:void(0)" class="elgg-anchor delete" rel="nofollow"><span class="elgg-anchor-label"><span class="elgg-icon elgg-icon-close fas fa-times"></span></span></a></div>`;

            parent.siblings('.multitext-values').first().append(html);
            input.val('');
        }
    });
});