<?php

$entity = elgg_extract('entity', $vars);

if (!$entity) {
    return;
}

$facepic = $entity->getEntitiesFromRelationship([
    'type' => 'object',
    'subtype' => 'awakening_reg_image',
    'relationship' => 'has_facepic'
]);

$img = elgg_view('output/img', [
    'src' => $facepic[0]->getInlineURL(),
    'style' => 'width: 150px'
]);

$body = '<h3>' . $entity->email . '</h3>';
$body .= '<p>' . $entity->intent . '</p>';

echo elgg_view_image_block($img, $body);