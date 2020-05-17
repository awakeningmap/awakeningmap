<?php

echo elgg_view_field([
    '#type' => 'number',
    '#label' => elgg_echo('widget:activity_group_list:setting:limit'),
    'name' => 'params[limit]',
    'value' => $vars['entity']->limit ? : 5,
    'min' => 1,
    'max' => 50
]);