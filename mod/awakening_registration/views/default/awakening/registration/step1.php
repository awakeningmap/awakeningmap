<?php

$yes = elgg_echo('registration:answer:yes');
$no = elgg_echo('registration:answer:no');
$maybe = elgg_echo('registration:answer:maybe');

$yesnomaybe = <<<YESNOMAYBE
    <button class="elgg-button-action button-yes">$yes</button>
    <button class="elgg-button-action button-no">$no</button>
    <button class="elgg-button-action button-dunno">$maybe</button>
YESNOMAYBE;

echo elgg_view('output/longtext', [
    'value' => elgg_echo('registration:step1:content')
]);

echo elgg_view_module('info', elgg_echo('registration:step1:question'), $yesnomaybe, [
    'class' => 'step step-1'
]);