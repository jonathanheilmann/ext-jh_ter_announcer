<?php
namespace Heilmann\JhTerAnnouncer\Task;

use \TYPO3\CMs\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Utility\VersionNumberUtility;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Jonathan Heilmann <mail@jonathan-heilmann.de>
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
 * Update extension list from ter
 *
 * @author Jonathan Heilmann <mail@jonathan-heilmann.de>
 */
class UpdateFromTerTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	public $objectManager = NULL;

	/**
	 * @var \TYPO3\CMS\Extensionmanager\Utility\Repository\Helper
	 */
	protected $repositoryHelper = NULL;

	/**
	 * Execute task to update feed.
	 *
	 * @return boolean TRUE if task run was successful
	 */
	public function execute() {
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->repositoryHelper = $this->objectManager->get('TYPO3\\CMS\\Extensionmanager\\Utility\\Repository\\Helper');
		$defaultFlashMessageQueue = $this->getDefaultFlashMessageQueue();

		$updated = FALSE;
		$errorMessage = '';

		if ($this->repositoryHelper->isExtListUpdateNecessary() !== 0) {
			try {
				$updated = $this->repositoryHelper->updateExtList();
			} catch (\TYPO3\CMS\Extensionmanager\Exception\ExtensionManagerException $e) {
				$flashMessage = GeneralUtility::makeInstance(
					'\\TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
					$e->getMessage(),
					'',
					\TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
				$defaultFlashMessageQueue->enqueue($flashMessage);
			} catch (\Exception $e) {
				$flashMessage = GeneralUtility::makeInstance(
					'\\TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
					$e->getMessage(),
					'',
					\TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
				$defaultFlashMessageQueue->enqueue($flashMessage);
			}
		} else {
			$flashMessage = GeneralUtility::makeInstance(
				'\\TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
				'Extension list is up to date',
				'',
				\TYPO3\CMS\Core\Messaging\FlashMessage::ERROR);
			$defaultFlashMessageQueue->enqueue($flashMessage);
		}

		return (boolean)$updated;
	}

	/**
	 * getDefaultFlashMessageQueue
	 *
	 * @return \TYPO3\CMS\Core\Messaging\FlashMessageQueue
	 */
	function getDefaultFlashMessageQueue() {
		/** @var $flashMessageService \TYPO3\CMS\Core\Messaging\FlashMessageService */
		$flashMessageService = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessageService');
		/** @var $defaultFlashMessageQueue \TYPO3\CMS\Core\Messaging\FlashMessageQueue */
		return $flashMessageService->getMessageQueueByIdentifier();
	}

	/**
	 * This method returns additional information
	 *
	 * @return string Information to display
	 */
	public function getAdditionalInformation() {
		return $message;
	}

}
