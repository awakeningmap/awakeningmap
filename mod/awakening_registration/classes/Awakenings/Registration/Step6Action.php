<?php

namespace Awakenings\Registration;

use Elgg\Request;
use ElggObject;

class Step6Action {
    public function __invoke(Request $request) {
        $email = $request->getParam('email');
        $name = $request->getParam('name');
        $password = $request->getParam('password');
        $password2 = $request->getParam('password2');
        $current_challenge = $request->getParam('current_challenge');
        $current_symptoms = $request->getParam('current_symptoms');
        $awakening_share = $request->getParam('awakening_share');
        $terms_accepted = $request->getParam('terms_and_conditions');

        $errors = [];

        if (!$name) {
            $errors[] = 'Please fill out your name';
        }

        try {
            validate_password($password);
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }

        if ($password !== $password2) {
            $errors[] = 'Passwords do not match, please try again';
        }

        try {
            validate_email_address($email, true);
        } catch (\Exception $e) {
            $errors[] = $e->getMessage();
        }

        if (!is_array($current_challenge) || !count($current_challenge)) {
            $errors[] = 'Please add at least one current challenge';
        }

        if (!is_array($current_symptoms) || !count($current_symptoms)) {
            $errors[] = 'Please add at least one current symptom';
        }

        if (!$awakening_share) {
            $errors[] = 'Please fill share about your awakening story';
        }

        if (count($errors)) {
            return elgg_error_response(implode('<br>', $errors), '', 400);
        }

        if (!$terms_accepted) {
            $errors[] = 'You must accept the terms and conditions';
        }

        // generate username
		list($username) = explode('@', $email);

		// remove any non-alphanum characters
		$username = preg_replace("/[^A-Za-z0-9]/", '', $username);

		// pad length if necessary
		if (strlen($username) < 4) {
			$username = $username . '00';
		}
		
		// check if username is unique
		$original_username = $username;
		
		$i = 1;
		while (get_user_by_username($username)) {
			$username = $original_username . $i;
			$i++;
		}

        try {
            $guid = register_user($username, $password, $name, $email);

            $user = get_user($guid);

            $user->reg_terms_accepted = time();
            $user->awakening_challenges = $current_challenge;
            $user->awakening_symptoms = $current_symptoms;
            $user->awakening_share = $awakening_share;

        } catch (\Exception $e) {
            return elgg_error_response($e->getMessage(), '', 400);
        }

        login($user);

        return elgg_ok_response('', 'Your account has been created', $user->getURL());
    }
}