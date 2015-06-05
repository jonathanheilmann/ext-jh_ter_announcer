<?php

namespace Heilmann\JhTerAnnouncer\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Jonathan Heilmann <mail@jonathan-heilmann.de>
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
 * Test case for class \Heilmann\JhTerAnnouncer\Domain\Model\Feed.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Jonathan Heilmann <mail@jonathan-heilmann.de>
 */
class FeedTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Heilmann\JhTerAnnouncer\Domain\Model\Feed
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Heilmann\JhTerAnnouncer\Domain\Model\Feed();
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
	public function getExtTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtTitle()
		);
	}

	/**
	 * @test
	 */
	public function setExtTitleForStringSetsExtTitle() {
		$this->subject->setExtTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extTitle',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtDescription()
		);
	}

	/**
	 * @test
	 */
	public function setExtDescriptionForStringSetsExtDescription() {
		$this->subject->setExtDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extDescription',
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
	public function getExtStateReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtState()
		);
	}

	/**
	 * @test
	 */
	public function setExtStateForStringSetsExtState() {
		$this->subject->setExtState('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extState',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtAuthorReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtAuthor()
		);
	}

	/**
	 * @test
	 */
	public function setExtAuthorForStringSetsExtAuthor() {
		$this->subject->setExtAuthor('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extAuthor',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtAuthorEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtAuthorEmail()
		);
	}

	/**
	 * @test
	 */
	public function setExtAuthorEmailForStringSetsExtAuthorEmail() {
		$this->subject->setExtAuthorEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extAuthorEmail',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtAuthorCompanyReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtAuthorCompany()
		);
	}

	/**
	 * @test
	 */
	public function setExtAuthorCompanyForStringSetsExtAuthorCompany() {
		$this->subject->setExtAuthorCompany('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extAuthorCompany',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtDependsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtDepends()
		);
	}

	/**
	 * @test
	 */
	public function setExtDependsForStringSetsExtDepends() {
		$this->subject->setExtDepends('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extDepends',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtConflictsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtConflicts()
		);
	}

	/**
	 * @test
	 */
	public function setExtConflictsForStringSetsExtConflicts() {
		$this->subject->setExtConflicts('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extConflicts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtSuggestsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtSuggests()
		);
	}

	/**
	 * @test
	 */
	public function setExtSuggestsForStringSetsExtSuggests() {
		$this->subject->setExtSuggests('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extSuggests',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExtLastUploadCommentReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getExtLastUploadComment()
		);
	}

	/**
	 * @test
	 */
	public function setExtLastUploadCommentForStringSetsExtLastUploadComment() {
		$this->subject->setExtLastUploadComment('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'extLastUploadComment',
			$this->subject
		);
	}
}
