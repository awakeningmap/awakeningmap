<?php

$content = elgg_view_form('awakening_registration/step6', ['ajax' => true], ['email' => $vars['email']]);

echo elgg_view_module('info', 'Please fill out the following to complete registration', $content, [
    'class' => 'step step-6'
]);