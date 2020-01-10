<?php

elgg_require_js('awakening/registration');

$yesnomaybe = <<<YESNOMAYBE
    <button class="elgg-button-action button-yes">Yes</button>
    <button class="elgg-button-action button-no">No</button>
    <button class="elgg-button-action button-dunno">I don't know</button>
YESNOMAYBE;

echo '<div class="awakening-registration" data-email="' . get_input('e') . '">';

echo elgg_view('awakening/registration/step1', [
    'email' => get_input('e')
]);

echo '</div>';