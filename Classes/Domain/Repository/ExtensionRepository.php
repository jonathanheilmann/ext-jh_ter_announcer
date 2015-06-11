<?php
namespace Heilmann\JhTerAnnouncer\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Jonathan Heilmann <mail@jonathan-heilmann.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The repository for Extensions
 */
class ExtensionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * defaultOrderings
	 *
	 * @var array
	 */
	protected $defaultOrderings = array(
		'lastUpdated' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
		'extensionKey' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);

	/**
	 * find rows by demand
	 *
	 * @param array $demand
	 * @param int $limit
	 * @return
	 */
	public function findByDemand($demand, $limit = NULL) {
		$query = $this->createQuery();
		if (count($demand) == 0) {
			return $query->execute();
		}
		$constraints = array();
		foreach ($demand as $key => $value) {
			switch ($value['comparison']) {
				case 'greaterThanOrEqual':
					$constraints[] = $query->greaterThanOrEqual($value['propertyName'], $value['operand']);
					break;
				case 'lessThan':
					$constraints[] = $query->lessThan($value['propertyName'], $value['operand']);
					break;
				case 'equals':
				default:
					$constraints[] = $query->equals($value['propertyName'], $value['operand']);
			}
		}
		switch ($conjunction) {
			case 'OR':
				$constraints = $query->logicalOr($constraints);
				break;
			case 'AND':
			default:
				$constraints = $query->logicalAnd($constraints);
		}
		if ($limit !== NULL && (int)$limit >= 1) {
			$query->setLimit((int)$limit);
		}
		$query->matching($constraints);
		return $query->execute();
	}
	
	/**
	 * find by currentVersion
	 * 
	 * @param boolean $currentVersion
	 * @param int $limit
	 * @return 
	 */
	public function findByCurrentVersion($currentVersion, $limit = NULL) {
		$query = $this->createQuery();
		if ($limit !== NULL && (int)$limit >= 1) {
			$query->setLimit((int)$limit);
		}
		$query->matching('currentVersion', $currentVersion);
		return $query->execute();
	}
	
}