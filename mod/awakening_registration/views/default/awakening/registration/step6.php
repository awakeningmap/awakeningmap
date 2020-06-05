<?php

$content = elgg_view_form('awakening_registration/step6', ['ajax' => true], ['email' => $vars['email']]);

echo elgg_view('output/longtext', [
    'value' => elgg_echo('registration:step6:content')
]);

echo elgg_view('output/url', [
    'text' => '<< ' . elgg_echo('registration:back'),
    'href' => 'javascript:void(0)',
    'class' => 'step step-back',
    'data-step' => 6
]);

echo elgg_view_module('info', elgg_echo('registration:step6:question'), $content, [
    'class' => 'step step-6'
]);