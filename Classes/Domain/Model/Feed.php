<?php
namespace Heilmann\JhTerAnnouncer\Domain\Model;


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
 * Record to create (rss) feed from.
 */
class Feed extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Extension key
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $extKey = '';

	/**
	 * Extension title
	 *
	 * @var string
	 */
	protected $extTitle = '';

	/**
	 * extDescription
	 *
	 * @var string
	 */
	protected $extDescription = '';

	/**
	 * Extension version number
	 *
	 * @var string
	 */
	protected $extVersion = '';

	/**
	 * Extension state
	 *
	 * @var string
	 */
	protected $extState = '';

	/**
	 * Extension author
	 *
	 * @var string
	 */
	protected $extAuthor = '';

	/**
	 * Extension author email
	 *
	 * @var string
	 */
	protected $extAuthorEmail = '';

	/**
	 * Extension author company
	 *
	 * @var string
	 */
	protected $extAuthorCompany = '';

	/**
	 * Serialized dependencies
	 *
	 * @var string
	 */
	protected $extDepends = '';

	/**
	 * Serialized conflicts
	 *
	 * @var string
	 */
	protected $extConflicts = '';

	/**
	 * Serialized suggestions
	 *
	 * @var string
	 */
	protected $extSuggests = '';

	/**
	 * extLastUploadComment
	 *
	 * @var string
	 */
	protected $extLastUploadComment = '';

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
	 * Returns the extTitle
	 *
	 * @return string $extTitle
	 */
	public function getExtTitle() {
		return $this->extTitle;
	}

	/**
	 * Sets the extTitle
	 *
	 * @param string $extTitle
	 * @return void
	 */
	public function setExtTitle($extTitle) {
		$this->extTitle = $extTitle;
	}

	/**
	 * Returns the extDescription
	 *
	 * @return string $extDescription
	 */
	public function getExtDescription() {
		return $this->extDescription;
	}

	/**
	 * Sets the extDescription
	 *
	 * @param string $extDescription
	 * @return void
	 */
	public function setExtDescription($extDescription) {
		$this->extDescription = $extDescription;
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
	 * Returns the extState
	 *
	 * @return string $extState
	 */
	public function getExtState() {
		return $this->extState;
	}

	/**
	 * Sets the extState
	 *
	 * @param string $extState
	 * @return void
	 */
	public function setExtState($extState) {
		$this->extState = $extState;
	}

	/**
	 * Returns the extAuthor
	 *
	 * @return string $extAuthor
	 */
	public function getExtAuthor() {
		return $this->extAuthor;
	}

	/**
	 * Sets the extAuthor
	 *
	 * @param string $extAuthor
	 * @return void
	 */
	public function setExtAuthor($extAuthor) {
		$this->extAuthor = $extAuthor;
	}

	/**
	 * Returns the extAuthorEmail
	 *
	 * @return string $extAuthorEmail
	 */
	public function getExtAuthorEmail() {
		return $this->extAuthorEmail;
	}

	/**
	 * Sets the extAuthorEmail
	 *
	 * @param string $extAuthorEmail
	 * @return void
	 */
	public function setExtAuthorEmail($extAuthorEmail) {
		$this->extAuthorEmail = $extAuthorEmail;
	}

	/**
	 * Returns the extAuthorCompany
	 *
	 * @return string $extAuthorCompany
	 */
	public function getExtAuthorCompany() {
		return $this->extAuthorCompany;
	}

	/**
	 * Sets the extAuthorCompany
	 *
	 * @param string $extAuthorCompany
	 * @return void
	 */
	public function setExtAuthorCompany($extAuthorCompany) {
		$this->extAuthorCompany = $extAuthorCompany;
	}

	/**
	 * Returns the extDepends
	 *
	 * @return string $extDepends
	 */
	public function getExtDepends() {
		return $this->extDepends;
	}

	/**
	 * Sets the extDepends
	 *
	 * @param string $extDepends
	 * @return void
	 */
	public function setExtDepends($extDepends) {
		$this->extDepends = $extDepends;
	}

	/**
	 * Returns the extConflicts
	 *
	 * @return string $extConflicts
	 */
	public function getExtConflicts() {
		return $this->extConflicts;
	}

	/**
	 * Sets the extConflicts
	 *
	 * @param string $extConflicts
	 * @return void
	 */
	public function setExtConflicts($extConflicts) {
		$this->extConflicts = $extConflicts;
	}

	/**
	 * Returns the extSuggests
	 *
	 * @return string $extSuggests
	 */
	public function getExtSuggests() {
		return $this->extSuggests;
	}

	/**
	 * Sets the extSuggests
	 *
	 * @param string $extSuggests
	 * @return void
	 */
	public function setExtSuggests($extSuggests) {
		$this->extSuggests = $extSuggests;
	}

	/**
	 * Returns the extLastUploadComment
	 *
	 * @return string $extLastUploadComment
	 */
	public function getExtLastUploadComment() {
		return $this->extLastUploadComment;
	}

	/**
	 * Sets the extLastUploadComment
	 *
	 * @param string $extLastUploadComment
	 * @return void
	 */
	public function setExtLastUploadComment($extLastUploadComment) {
		$this->extLastUploadComment = $extLastUploadComment;
	}

}