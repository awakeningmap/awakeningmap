<?php

$entity = elgg_extract('entity', $vars);
$default = elgg_extract('value', $vars, []);

if (!$entity && !$default) {
    return;
}

$value = $entity ? $entity->{$vars['name']} : $default;

$value = (array) $value;

foreach ($value as $val) {
    echo elgg_format_element('div', ['class' => 'multi-text-value-item'], $val);
}