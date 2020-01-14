define(['elgg', 'jquery'], function(elgg, $) {
    
    $(document).on('click', '.step-6-form .next', function() {
        $(this).parents('.step-6-form').first().fadeOut(400, function() {
            $('.step-6-form.step-6-2').fadeIn(200);
        });
    });

    $(document).on('click', '.step-6-form .previous', function() {
        $(this).parents('.step-6-form').first().fadeOut(400, function() {
            $('.step-6-form.step-6-1').fadeIn(200);
        });
    });
});