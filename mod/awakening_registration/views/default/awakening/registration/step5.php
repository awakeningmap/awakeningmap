<?php

$content = elgg_view_form('awakening_registration/step5', ['ajax' => true], ['email' => $vars['email']]);

echo elgg_view('output/url', [
    'text' => '<< Back',
    'href' => 'javascript:void(0)',
    'class' => 'step step-back',
    'data-step' => 5
]);

echo elgg_view_module('info', 'Speak to an enlightened individual', $content, [
    'class' => 'step step-5'
]);

