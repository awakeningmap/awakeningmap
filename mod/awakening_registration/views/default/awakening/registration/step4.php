<?php

$video_url = elgg_echo('registration:step4:video_url');

$content = '<iframe width="560" height="315" src="' . $video_url . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

$content .= '<div style="padding-top: 30px">';
$content .= '<p>' . elgg_echo('registration:step4:q1') . '</p>';
$content .= '<button class="elgg-button-action button-yes">' . elgg_echo('registration:step4:q1:answer:yes') . '</button><br>';
$content .= '<button class="elgg-button-action button-dunno">' . elgg_echo('registration:step4:q1:answer:maybe') . '</button><br>';
$content .= '<button class="elgg-button-action button-no">' . elgg_echo('registration:step4:q1:answer:no') . '</button>';
$content .= '</div>';

echo elgg_view('output/longtext', [
    'value' => elgg_echo('registration:step4:content')
]);

echo elgg_view('output/url', [
    'text' => '<< ' . elgg_echo('registration:back'),
    'href' => 'javascript:void(0)',
    'class' => 'step step-back',
    'data-step' => 4
]);

echo elgg_view_module('info', elgg_echo('registration:step4:question'), $content, [
    'class' => 'step step-4'
]);