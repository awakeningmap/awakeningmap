<?php

elgg_require_js('input/reg_challenges');

echo '<div class="reg-challenge-wrapper" data-name="' . $vars['name'] . '">';
echo elgg_view('input/text', [
    'value' => '',
    'class' => 'reg-challenges'
]);

echo '<button type="button" class="elgg-button-action add">';
echo elgg_view_icon('plus');
echo '</button>';

echo '</div>';

echo '<div class="reg-challenge-values">';

if (isset($vars['value']) && $vars['value']) {
    $val = (array) $vars['value'];

    foreach ($val as $v) {
        echo '<div class="reg-challenge-value">';
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

echo '</div>';