<?php

elgg_require_js('forms/awakening_registration/step6');

echo '<div class="step-6-form step-6-1">';
echo elgg_view_field([
    '#type' => 'text',
    '#label' => 'Name',
    'name' => 'name'
]);

echo elgg_view_field([
    '#type' => 'email',
    '#label' => 'Email',
    'name' => 'email',
    'value' => $vars['email']
]);

echo elgg_view_field([
    '#type' => 'password',
    '#label' => 'Password',
    'name' => 'password',
    'value' => ''
]);

echo elgg_view_field([
    '#type' => 'password',
    '#label' => 'Password Again',
    'name' => 'password2',
    'value' => ''
]);

echo elgg_view_field([
    '#type' => 'multitext',
    '#label' => 'What are some of your current awakening symptoms',
    'name' => 'current_symptoms',
    'value' => []
]);

echo elgg_view_field([
    '#type' => 'multitext',
    '#label' => 'What are some of your current awakening challenges',
    'name' => 'current_challenges',
    'value' => []
]);

echo '<div class="challenge_output"></div>';

echo elgg_view_field([
    '#type' => 'plaintext',
    '#label' => 'What is a fascinating share from your Awakening Story, what are you grateful for?',
    'name' => 'awakening_share'
]);

echo '<button type="button" class="elgg-button-action next">Next</button>';

echo '</div>';

echo '<div class="step-6-form step-6-2 step-hidden">';
    echo '<button type="button" class="elgg-button-action previous">Back</button>';

    echo '<p>' . elgg_get_plugin_setting('registration_foreword', 'awakening_registration') . '</p>';

echo elgg_view_field([
    '#type' => 'checkbox',
    '#label' => 'I have read the <a href="/terms" target="_blank">Terms and Conditions</a>',
    'value' => 1,
    'name' => 'terms_and_conditions'
]);

echo elgg_view_field([
    '#type' => 'submit',
    'value' => 'Submit'
]);

echo '</div>';