<?php

$entity = elgg_extract('entity', $vars);
$default = elgg_extract('value', $vars, []);

if (!$entity && !$default) {
    return;
}

$value = $entity ? (array) $entity->{$vars['name']} : (array) $default;

$newval = [];

// sort the values
if (count($value)) {
    foreach ($value as $key => $val) {
        if ($key === 0 || ($key % 2) === 0) {
            continue;
        }

        $newval[] = [
            'date' => $value[$key - 1],
            'text' => $val
        ];
    }

    usort($newval, function($a, $b) {
        if (strtotime($a['date']) === strtotime($b['date'])) {
            return 0;
        }

        return strtotime($a['date']) > strtotime($b['date']) ? 1 : -1;
    });
}

if (count($newval)) {
    echo '<ul class="multidatetext-value-output">';
    foreach ($newval as $arr) {
        echo '<li><div class="date">' . $arr['date'] . '</div><div class="text">' . $arr['text'] . '</div></li>';
    }
    echo '</ul>';
}