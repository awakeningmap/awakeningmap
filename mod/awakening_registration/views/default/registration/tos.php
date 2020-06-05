<?php

$entities = elgg_get_entities([
    'metadata_name_value_pairs' => [
        [
            'name' => 'slug',
            'value' => ['terms', '/terms'],
            'case_sensitive' => false,
        ],
    ],
    'limit' => 1,
]);

if ($entities) {
    $entity = array_shift($entities);

    echo $entity->description;
}
else {
    echo 'No terms found';
}