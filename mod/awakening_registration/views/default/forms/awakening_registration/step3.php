<?php

echo elgg_view_field([
    '#type' => 'plaintext',
    '#label' => elgg_echo('registration:step3:intent'),
    '#help' => elgg_echo('registration:step3:intent:help'),
    'name' => 'intent'
]);

echo elgg_view_field([
    '#type' => 'email',
    '#label' => elgg_echo('registration:step3:email'),
    '#help' => elgg_echo('registration:step3:email:help'),
    'name' => 'email',
    'value' => $vars['email']
]);

echo elgg_view_field([
    '#type' => 'dropzone',
    '#label' => elgg_echo('registration:step3:facepic'),
    '#help' => elgg_echo('registration:step3:facepic:help'),
    'name' => 'facepic',
    'action' => 'action/registration/image_upload',
    'multiple' => false,
    'max' => 1
]);

echo elgg_view_field([
    '#type' => 'submit',
    'value' => elgg_echo('submit')
]);