<?php
namespace Heilmann\JhTerAnnouncer\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014
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
 * Log
 */
class Log extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Extension key
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $extKey = '';

	/**
	 * Extension version number
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $extVersion = '';

	/**
	 * Sent announcement
	 *
	 * @var boolean
	 */
	protected $sentAnnouncement = FALSE;

	/**
	 * Returns the extKey
	 *
	 * @return string $extKey
	 */
	public function getExtKey() {
		return $this->extKey;
	}

	/**
	 * Sets the extKey
	 *
	 * @param string $extKey
	 * @return void
	 */
	public function setExtKey($extKey) {
		$this->extKey = $extKey;
	}

	/**
	 * Returns the extVersion
	 *
	 * @return string $extVersion
	 */
	public function getExtVersion() {
		return $this->extVersion;
	}

	/**
	 * Sets the extVersion
	 *
	 * @param string $extVersion
	 * @return void
	 */
	public function setExtVersion($extVersion) {
		$this->extVersion = $extVersion;
	}

	/**
	 * Returns the sentAnnouncement
	 *
	 * @return boolean $sentAnnouncement
	 */
	public function getSentAnnouncement() {
		return $this->sentAnnouncement;
	}

	/**
	 * Sets the sentAnnouncement
	 *
	 * @param boolean $sentAnnouncement
	 * @return void
	 */
	public function setSentAnnouncement($sentAnnouncement) {
		$this->sentAnnouncement = $sentAnnouncement;
	}

	/**
	 * Returns the boolean state of sentAnnouncement
	 *
	 * @return boolean
	 */
	public function isSentAnnouncement() {
		return $this->sentAnnouncement;
	}

}