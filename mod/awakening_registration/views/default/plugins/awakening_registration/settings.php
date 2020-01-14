<?php

echo elgg_view_field([
    '#type' => 'longtext',
    '#label' => '',
    'name' => 'params[registration_foreword]',
    'value' => $vars['entity']->registration_foreword
]);