<?php
$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \ElggEntity) {
	return;
}

$svc = elgg()->{'posts.model'};
/* @var $svc \hypeJunction\Post\Model */

$fields = $svc->getFields($entity, \hypeJunction\Fields\Field::CONTEXT_PROFILE);

$output = '';

$output .= elgg_view('output/longtext', [
	'value' => $entity->description,
	'class' => 'groups-description',
]);

foreach ($fields as $field) {
    
    // ignore location for countries
    if ($entity->getSubtype() == 'country' && $field->name == 'location') {
        continue;
    }

	/* @var $field \hypeJunction\Fields\FieldInterface */
	$output .= $field->output($entity);
}

if (!$entity->isMember()) {
	$count = $entity->getMembers(['count' => true]);
	$members = 'members';
	if ($count === 1) {
		$members = 'member';
	}

	$output .= '<div class="post-field-output">';
	$output .= '<div class="post-field-label">Membership</div>';
	$output .= '<div class="post-field-value">' . $count . ' ' . $members . '</div>';
	$output .= '</div>';
}

if (empty($output)) {
	if ($entity->canEdit()) {
		$edit = elgg_view('output/url', [
			'href' => elgg_generate_entity_url($entity, 'edit'),
			'text' => elgg_echo("edit:$entity->type:$entity->subtype"),
			'icon_alt' => 'chevron-right',
		]);
		$message = elgg_echo('groups:profile:empty', [$edit]);
		echo elgg_view_message('notice', $message, [
			'title' => false,
		]);
	}
} else {
	echo $output;
}