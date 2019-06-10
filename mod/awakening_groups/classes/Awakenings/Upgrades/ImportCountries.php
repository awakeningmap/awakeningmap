<?php

namespace Awakenings\Upgrades;

use Awakenings\Groups\Country;
use Elgg\Upgrade\AsynchronousUpgrade;
use Elgg\Upgrade\Result;
use hypeJunction\Countries;

class ImportCountries implements AsynchronousUpgrade {

	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::getVersion()
	 */
	public function getVersion() {
		return 2019052900;
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
		$count = elgg_get_entities([
			'count' => true,
			'types' => 'group',
			'subtypes' => 'country',
		]);

		return $this->countItems() === $count;
	}

	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::countItems()
	 */
	public function countItems() {
		return count(Countries::getCountries());
	}

	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::run()
	 * @throws \IOException
	 */
	public function run(Result $result, $offset) {
		$countries = Countries::getCountries();
		$site = elgg_get_site_entity();

		$ia = elgg_set_ignore_access(true);

		foreach ($countries as $country) {
			if ($this->exists($country)) {
				continue;
			}

			$group = new Country();
			$group->container_guid = $site->guid;
			$group->owner_guid = $site->guid;
			$group->name = $country->name;
			$group->country_code = $country->iso3;
			$group->location = join(', ', [$country->capital, $country->name]);
			$group->access_id = ACCESS_PUBLIC;
			$group->membership = ACCESS_PUBLIC;
			$group->setContentAccessMode(\ElggGroup::CONTENT_ACCESS_MODE_UNRESTRICTED);

			if ($group->save()) {
				$result->addSuccesses(1);

				$group->saveIconFromLocalFile(elgg_get_plugins_path() . 'awakening_groups/views/default/countries/flags/' . strtolower($country->iso) . '.png');
			} else {
				$result->addFailures(1);
			}
		}

		elgg_set_ignore_access($ia);
	}

	public function exists($country) {
		return elgg_get_entities([
			'count' => true,
			'types' => 'group',
			'metadata_name_value_pairs' => [
				'country_code' => $country->iso3,
			]
		]);
	}
}
