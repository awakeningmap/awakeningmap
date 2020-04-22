<?php

$yesnomaybe = <<<YESNOMAYBE
    <button class="elgg-button-action button-yes">Yes</button>
    <button class="elgg-button-action button-no">No</button>
    <button class="elgg-button-action button-dunno">I don't know</button>
YESNOMAYBE;

echo elgg_view('output/url', [
    'text' => '<< Back',
    'href' => 'javascript:void(0)',
    'class' => 'step step-back',
    'data-step' => 2
]);

echo elgg_view_module('info', 'Would you like to meet and share with others who are also awakening?', $yesnomaybe, [
    'class' => 'step step-2'
]);