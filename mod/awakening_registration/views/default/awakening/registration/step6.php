<?php

$content = elgg_view_form('awakening_registration/step6', ['ajax' => true], ['email' => $vars['email']]);

echo elgg_view('output/url', [
    'text' => '<< Back',
    'href' => 'javascript:void(0)',
    'class' => 'step step-back',
    'data-step' => 6
]);

echo elgg_view_module('info', 'Please fill out the following to complete registration', $content, [
    'class' => 'step step-6'
]);