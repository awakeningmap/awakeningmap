<?php

namespace Awakenings\Upgrades;

use Awakenings\Groups\Country;
use Elgg\Upgrade\AsynchronousUpgrade;
use Elgg\Upgrade\Result;
use hypeJunction\Countries;

class SetGroupOwnership implements AsynchronousUpgrade {

	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::getVersion()
	 */
	public function getVersion() {
		return 2020052000;
	}

	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::needsIncrementOffset()
	 */
	public function needsIncrementOffset() {
		return false;
	}

	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::shouldBeSkipped()
	 */
	public function shouldBeSkipped() {
		return false;
	}

	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::countItems()
	 */
	public function countItems() {
        $count = elgg_get_entities([
            'type' => 'group',
            'subtypes' => ['private', 'country', 'region'],
            'count' => true
        ]);

		return $count;
	}

	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::run()
	 * @throws \IOException
	 */
	public function run(Result $result, $offset) {
		$groups = elgg_get_entities([
            'type' => 'group',
            'subtypes' => ['private', 'country', 'region'],
            'limit' => false,
            'batch' => true
        ]);

		$site = elgg_get_site_entity();

		$ia = elgg_set_ignore_access(true);

		foreach ($groups as $group) {
            $group->owner_guid = $site->guid;
            $group->save();

            $result->addSuccesses();
		}

		elgg_set_ignore_access($ia);
	}
}
