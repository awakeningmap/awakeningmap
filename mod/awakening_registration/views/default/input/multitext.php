<?php

$entity = elgg_extract('entity', $vars);
$default = elgg_extract('value', $vars, []);

$value = $entity ? $entity->{$vars['name']} : $default;

$value = (array) $value;

$value = array_filter($value);

elgg_require_js('input/multitext');

echo '<div class="multitext-wrapper" data-name="' . $vars['name'] . '">';
echo elgg_view('input/text', [
    'value' => '',
    'class' => 'input-multitext'
]);

echo '<button type="button" class="elgg-button-action add">';
echo elgg_view_icon('plus');
echo '</button>';

echo '</div>';

echo '<div class="multitext-values" data-name="' . $vars['name'] . '">';

if (count($value)) {
    foreach ($value as $v) {
        echo '<div class="multitext-value">';
        echo elgg_view('input/hidden', [
            'name' => $vars['name'] . '[]',
            'value' => $v
        ]);

        echo '<div class="value">' . $v . '</div>';
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