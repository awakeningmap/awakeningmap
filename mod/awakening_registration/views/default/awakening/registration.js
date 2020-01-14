define(['elgg', 'elgg/Ajax', 'jquery'], function(elgg, Ajax, $) {

    var ajax = new Ajax();
    var $container = $('.awakening-registration');
    var email = $container.data('email');

    var goToStep = function(step) {
        ajax.view('awakening/registration/step' + step, {
            data: {
                email: email
            }
        })
            .done((function (output, statusText, jqXHR) {
                if (jqXHR.AjaxData.status == -1) {
                    return;
                }
            
                $container.html(output);
            }));
    };


    $(document).on('click', '.step-1 .button-yes, .step-4 .button-yes', function() {
        goToStep(2);
    });

    $(document).on('click', '.step-1 .button-no, .step-2 .button-no', function() {
        goToStep(3);
    });

    $(document).on('click', '.step-1 .button-dunno, .step-2 .button-dunno', function() {
        goToStep(4);
    });

    $(document).on('click', '.step-4 .button-dunno', function() {
        goToStep(5);
    });

    $(document).on('click', '.step-4 .button-no', function() {
        window.location = elgg.get_site_url();
    });

    $(document).on('click', '.step-2 .button-yes', function() {
        goToStep(6);
    });
});