<?php

elgg_require_js('forms/awakening_registration/step6');

echo '<div class="step-6-form step-6-1">';
echo elgg_view_field([
    '#type' => 'text',
    '#label' => elgg_echo('registration:step6:questions:name'),
    '#help' => elgg_echo('registration:step6:questions:name:help'),
    'name' => 'name'
]);

echo elgg_view_field([
    '#type' => 'email',
    '#label' => elgg_echo('registration:step6:questions:email'),
    '#help' => elgg_echo('registration:step6:questions:email:help'),
    'name' => 'email',
    'value' => $vars['email']
]);

echo elgg_view_field([
    '#type' => 'password',
    '#label' => elgg_echo('registration:step6:questions:password'),
    '#help' => elgg_echo('registration:step6:questions:password:help'),
    'name' => 'password',
    'value' => ''
]);

echo elgg_view_field([
    '#type' => 'password',
    '#label' => elgg_echo('registration:step6:questions:password2'),
    '#help' => elgg_echo('registration:step6:questions:password2:help'),
    'name' => 'password2',
    'value' => ''
]);

echo elgg_view_field([
    '#type' => 'multitext',
    '#label' => elgg_echo('registration:step6:questions:current_symptoms'),
    '#help' => elgg_echo('registration:step6:questions:current_symptoms:help'),
    'name' => 'current_symptoms',
    'value' => []
]);

echo elgg_view_field([
    '#type' => 'multitext',
    '#label' => elgg_echo('registration:step6:questions:current_challenges'),
    '#help' => elgg_echo('registration:step6:questions:current_challenges:help'),
    'name' => 'current_challenges',
    'value' => []
]);

echo elgg_view_field([
    '#type' => 'plaintext',
    '#label' => elgg_echo('registration:step6:questions:awakening_share'),
    '#help' => elgg_echo('registration:step6:questions:awakening_share:help'),
    'name' => 'awakening_share'
]);

$next = elgg_echo('registration:next');
$back = elgg_echo('registration:back');

echo '<button type="button" class="elgg-button-action next">' . $next . '</button>';

echo '</div>';

echo '<div class="step-6-form step-6-2 step-hidden">';
    echo '<button type="button" class="elgg-button-action previous">' . $back . '</button>';

    echo '<p>' . elgg_get_plugin_setting('registration_foreword', 'awakening_registration') . '</p>';

$link = elgg_view('output/url', [
    'text' => elgg_echo('registration:tos'),
    'href' => elgg_normalize_url('/ajax/view/registration/tos'),
    'class' => 'elgg-lightbox'
]);
$tos = elgg_echo('registration:step6:questions:tos', [$link]);

echo elgg_view_field([
    '#type' => 'checkbox',
    '#label' => $tos,
    'value' => 1,
    'name' => 'terms_and_conditions'
]);

echo elgg_view('output/longtext', [
    'value' => elgg_echo('registration:step6:post-question-content')
]);

echo elgg_view_field([
    '#type' => 'submit',
    'value' => 'Submit'
]);

echo '</div>';