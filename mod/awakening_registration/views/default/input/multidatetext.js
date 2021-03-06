define(['elgg', 'jquery'], function(elgg, $) {
    $(document).on('click', '.multidatetext-value .delete', function() {
        var valuesWrapper = $(this).parents('.multidatetext-values').first();
        var valuesCount = valuesWrapper.find('.multidatetext-value').length;

        $(this).parents('.multidatetext-value').first().remove();

        if (valuesCount <= 1) {
            var name = valuesWrapper.attr('data-name');
            valuesWrapper.append(`<input type="hidden" name="${name}[]" value="" class="default">`);
        }
    });

    $(document).on('click', '.multidatetext-wrapper .add', function() {
        var parent = $(this).parents('.multidatetext-wrapper').first();
        var input = parent.find('.input-multidatetext-text');
        var dateInput = parent.find('.input-multidatetext-date');

        if (input.val() && dateInput.val()) {
            parent.siblings('.multidatetext-values').first().find('.default').remove();

            var name = $(this).parents('.multidatetext-wrapper').first().attr('data-name');
            var html = `<div class="multidatetext-value">
                            <input name="${name}[]" value="${dateInput.val()}" type="hidden">
                            <input name="${name}[]" value="${input.val()}" type="hidden">
                            <div class="value">
                                <div class="date">${dateInput.val()}</div>
                                <div class="text">${input.val()}</div>
                            </div>
                            <a href="javascript:void(0)" class="elgg-anchor delete" rel="nofollow">
                                <span class="elgg-anchor-label">
                                    <span class="elgg-icon elgg-icon-close fas fa-times"></span>
                                </span>
                            </a>
                        </div>`;

            parent.siblings('.multidatetext-values').first().append(html);
            input.val('');
            dateInput.val('');
        }
    });
});