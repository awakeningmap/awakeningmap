<?php

$content = elgg_view_form('awakening_registration/step3', ['ajax' => true], ['email' => $vars['email']]);

echo elgg_view('output/longtext', [
    'value' => elgg_echo('registration:step3:content')
]);

echo elgg_view('output/url', [
    'text' => '<< ' . elgg_echo('registration:back'),
    'href' => 'javascript:void(0)',
    'class' => 'step step-back',
    'data-step' => 3
]);

echo elgg_view_module('info', elgg_echo('registration:step3:question'), $content, [
    'class' => 'step step-3'
]);

