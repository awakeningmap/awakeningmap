<?php

echo elgg_view_field([
    '#type' => 'plaintext',
    '#label' => 'Initial questions/comments',
    'name' => 'intent'
]);

echo elgg_view_field([
    '#type' => 'email',
    '#label' => 'Your email address',
    'name' => 'email',
    'value' => $vars['email']
]);

echo elgg_view_field([
    '#type' => 'dropzone',
    '#label' => 'Please upload a current face picture',
    'name' => 'facepic',
    'action' => 'action/registration/image_upload',
    'multiple' => false,
    'max' => 1
]);

echo elgg_view_field([
    '#type' => 'submit',
    'value' => elgg_echo('submit')
]);