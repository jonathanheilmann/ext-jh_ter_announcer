<?php

namespace Heilmann\JhTerAnnouncer\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Heilmann\JhTerAnnouncer\Domain\Model\Log.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LogTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Heilmann\JhTerAnnouncer\Domain\Model\Log
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Heilmann\JhTerAnnouncer\Domain\Model\Log();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getExtKeyReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtKey()
		);
	}

	/**
	 * @test
	 */
	public function setExtKeyForStringSetsExtKey() {
		$this->subject->setExtKey('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extKey',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtVersionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtVersion()
		);
	}

	/**
	 * @test
	 */
	public function setExtVersionForStringSetsExtVersion() {
		$this->subject->setExtVersion('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extVersion',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSentAnnouncementReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getSentAnnouncement()
		);
	}

	/**
	 * @test
	 */
	public function setSentAnnouncementForBooleanSetsSentAnnouncement() {
		$this->subject->setSentAnnouncement(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'sentAnnouncement',
			$this->subject
		);
	}
}
