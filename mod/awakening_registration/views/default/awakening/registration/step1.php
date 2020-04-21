<?php

$yesnomaybe = <<<YESNOMAYBE
    <button class="elgg-button-action button-yes">Yes</button>
    <button class="elgg-button-action button-no">No</button>
    <button class="elgg-button-action button-dunno">I don't know</button>
YESNOMAYBE;

echo elgg_view_module('info', 'Are you currently experiencing , or have you ever experienced an awakening?', $yesnomaybe, [
    'class' => 'step step-1'
]);