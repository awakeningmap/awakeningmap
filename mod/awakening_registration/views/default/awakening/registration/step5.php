<?php

$content = elgg_view_form('awakening_registration/step5', ['ajax' => true], ['email' => $vars['email']]);

echo elgg_view_module('info', 'Speak to an enlightened individual', $content, [
    'class' => 'step step-5'
]);

