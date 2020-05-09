<?php

echo elgg_list_entities([
    'type' => 'group',
    'subtype' => 'private',
    'limit' => $vars['entity']->limit ? : 5,
    'pagination' => false
]);

echo elgg_view('output/url', [
    'text' => elgg_echo('widget:activity_group_list:morelink'),
    'href' => elgg_get_site_url() . 'private_groups/all'
]);