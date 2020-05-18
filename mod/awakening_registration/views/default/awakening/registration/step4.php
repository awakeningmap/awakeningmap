<?php

$content = '<iframe width="560" height="315" src="https://www.youtube.com/embed/C0DPdy98e4c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

$content .= '<div style="padding-top: 30px">';
$content .= '<p>How would you like to proceed?</p>';
$content .= '<button class="elgg-button-action button-yes">Join awakeningmap.com and complete registration</button><br>';
$content .= '<button class="elgg-button-action button-dunno">Speak with an enlightened individual</button><br>';
$content .= '<button class="elgg-button-action button-no">Go on with my life and return if I think I am awakening</button>';
$content .= '</div>';

echo elgg_view('output/url', [
    'text' => '<< Back',
    'href' => 'javascript:void(0)',
    'class' => 'step step-back',
    'data-step' => 4
]);

echo elgg_view_module('info', 'Please watch the following video', $content, [
    'class' => 'step step-4'
]);