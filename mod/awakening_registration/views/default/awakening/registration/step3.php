<?php

$content = elgg_view_form('awakening_registration/step3', ['ajax' => true], ['email' => $vars['email']]);

echo elgg_view_module('info', 'Since you answered no, what is your intent?', $content, [
    'class' => 'step step-3'
]);

