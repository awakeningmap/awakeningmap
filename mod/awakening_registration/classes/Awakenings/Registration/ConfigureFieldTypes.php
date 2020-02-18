<?php

namespace Awakenings\Registration;

use Elgg\HooksRegistrationService\Hook;
use hypeJunction\Attachments\AttachmentsField;
use hypeJunction\Countries\AddressField;
use hypeJunction\Fields\BooleanField;
use hypeJunction\Fields\CustomHtml;
use hypeJunction\Fields\MetaField;
use hypeJunction\Fields\TagsField;
use hypeJunction\Profile\ProfileField;

class ConfigureFieldTypes {

	public function __invoke(Hook $hook) {
		$field_types = $hook->getValue() ? : [];

		$field_types[] = [
			'type' => 'multitext',
			'label' => elgg_echo('post:admin:type:multitext'),
			'config' => [],
			'adapter' => function ($params, $entity) {
				if (elgg_is_active_plugin('hypeProfile') && $entity instanceof \ElggUser) {
					return new ProfileField($params);
				}

				return new MetaField($params);
			}
		];

		return $field_types;
	}
}