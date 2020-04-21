<?php

namespace Awakenings\Registration;

use Elgg\Request;
use ElggObject;

class Step3Action {
    public function __invoke(Request $request) {
        $facepic = $request->getParam('facepic');
        $intent = $request->getParam('intent');
        $email = $request->getParam('email');

        if (!$intent) {
            return elgg_error_response('Please fill out your intent for using the site');
        }

        if (!is_email_address($email)) {
            return elgg_error_response('Please use a valid email address');
        }

        if (!is_numeric($facepic)) {
            return elgg_error_response('Please upload a face pic');
        }

        $ia = elgg_set_ignore_access(true);

        $submission = new ElggObject();
        $submission->subtype = 'awakening_reg_step3';
        $submission->owner_guid = elgg_get_site_entity()->guid;
        $submission->container_guid = elgg_get_site_entity()->guid;
        $submission->intent = $intent;
        $submission->email = $email;
        
        if (!$submission->save()) {
            return elgg_error_response('There was an issue saving your information, please try again');
        }

        $submission->addRelationship($facepic, 'has_facepic');

        elgg_set_ignore_access($ia);

        return elgg_ok_response('', 'Thank you for your interest, an administrator will review and get back to you.', '/awakening/register/step3_complete');
    }
}