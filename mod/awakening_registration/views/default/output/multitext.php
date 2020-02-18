<?php

$entity = elgg_extract('entity', $vars);
$default = elgg_extract('value', $vars, []);

if (!$entity && !$default) {
    return;
}

$value = $entity ? $entity->{$vars['name']} : $default;

$value = (array) $value;

$value = array_filter($value);

if (count($value)) {
    echo '<ol class="multitext-value-output">';
    foreach ($value as $val) {
        echo '<li>' . $val . '</li>';
    }
    echo '</ol>';
}