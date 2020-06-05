<?php

echo elgg_view_field([
    '#type' => 'plaintext',
    '#label' => elgg_echo('registration:step5:questions:comment'),
    '#help' => elgg_echo('registration:step5:questions:comment:help'),
    'name' => 'intent'
]);

echo elgg_view_field([
    '#type' => 'email',
    '#label' => elgg_echo('registration:step5:questions:email'),
    '#help' => elgg_echo('registration:step5:questions:email:help'),
    'name' => 'email',
    'value' => $vars['email']
]);

echo elgg_view_field([
    '#type' => 'dropzone',
    '#label' => elgg_echo('registration:step5:questoins:facepic'),
    '#help' => elgg_echo('registration:step5:questions:facepic:help'),
    'name' => 'facepic',
    'action' => 'action/registration/image_upload',
    'multiple' => false,
    'max' => 1
]);

echo elgg_view_field([
    '#type' => 'submit',
    'value' => elgg_echo('submit')
]);