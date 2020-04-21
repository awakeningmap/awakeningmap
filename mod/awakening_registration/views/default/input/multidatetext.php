<?php

$entity = elgg_extract('entity', $vars);
$default = elgg_extract('value', $vars, []);

if (!$entity && !$default) {
    return;
}

$value = $entity ? $entity->{$vars['name']} : $default;

$value = (array) $value;

$value = array_filter($value);

elgg_require_js('input/multidatetext');

echo '<div class="multidatetext-wrapper" data-name="' . $vars['name'] . '">';
echo elgg_view_field([
    '#type' => 'date',
    'class' => 'input-multidatetext-date',
    'timestamp' => false,
    'placeholder' => isset($vars['date-placeholder']) ? $vars['date-placeholder']: 'Date',
    'format' => isset($vars['date-format']) ? $vars['date-format'] : 'Y-m-d',
    'datepicker_options' => ['dateFormat' => 'yy-mm-dd'],
    'autocomplete' => 'off'
]);

echo elgg_view_field([
    '#type' => 'text',
    'class' => 'input-multidatetext-text',
    'placeholder' => isset($vars['placeholder']) ? $vars['placeholder'] : 'Description'
]);

echo '<button type="button" class="elgg-button-action add">';
echo elgg_view_icon('plus');
echo '</button>';

echo '</div>';

echo '<div class="multidatetext-values" data-name="' . $vars['name'] . '">';

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
    foreach ($newval as $arr) {

        echo '<div class="multidatetext-value">';
        echo elgg_view('input/hidden', [
            'name' => $vars['name'] . '[]',
            'value' => $arr['date']
        ]);
        echo elgg_view('input/hidden', [
            'name' => $vars['name'] . '[]',
            'value' => $arr['text']
        ]);

        echo '<div class="value">';
        echo '<div class="date">' . $arr['date']. '</div>';
        echo '<div class="text">' . $arr['text'] . '</div>';
        echo '</div>';

        echo elgg_view('output/url', [
            'text' => elgg_view_icon('close'),
            'href' => 'javascript:void(0)',
            'class' => 'delete'
        ]);

        echo '</div>';
    }
}
else {
    echo elgg_view('input/hidden', [
        'name' => $vars['name'] . '[]',
        'value' => '',
        'class' => 'default'
    ]);
}

echo '</div>';