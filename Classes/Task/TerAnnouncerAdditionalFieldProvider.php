<?php
namespace Heilmann\JhTerAnnouncer\Task;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014-2015 Jonathan Heilmann <mail@jonathan-heilmann.de>
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
 * Additional BE fields for TER announcer
 *
 * @Jonathan Heilmann <mail@jonathan-heilmann.de>
 */
class TerAnnouncerAdditionalFieldProvider implements \TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface {

	/**
	 * Add additional fields
	 *
	 * @param array $taskInfo Reference to the array containing the info used in the add/edit form
	 * @param object $task When editing, reference to the current task object. Null when adding.
	 * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject Reference to the calling object (Scheduler's BE module)
	 * @return array Array containing all the information pertaining to the additional fields
	 */
	public function getAdditionalFields(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {
		if ($parentObject->CMD === 'edit') {
			$value['blacklist'] = $task->blacklist;
			$value['email'] = $task->email;
			$value['templateRootPath'] = $task->templateRootPath;
		} else {
			$value['blacklist'] = '';
			$value['email'] = '';
			$value['templateRootPath'] = 'EXT:jh_ter_announcer/Resources/Private/Templates/';
		}
		// blacklist
		$fieldName = 'tx_scheduler[jhTerAnnouncer_terAnnouncer_blacklist]';
		$fieldId = 'task_terAnnouncer_blacklist';
		$fieldHtml = '<input type="input" value="' . $value['blacklist'] . '" ' . 'name="' . $fieldName . '" ' . 'id="' . $fieldId . '" />';
		$additionalFields['task_terAnnouncer_blacklist'] = array(
			'code' => $fieldHtml,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang.xlf:label.task_terAnnouncer.blacklist',
			'cshKey' => '_MOD_system_txschedulerM1',
			'cshLabel' => $fieldId
		);
		//email
		$fieldName = 'tx_scheduler[jhTerAnnouncer_terAnnouncer_email]';
		$fieldId = 'task_terAnnouncer_email';
		$fieldHtml = '<input type="input" value="' . $value['email'] . '" ' . 'name="' . $fieldName . '" ' . 'id="' . $fieldId . '" />';
		$additionalFields['task_terAnnouncer_email'] = array(
			'code' => $fieldHtml,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang.xlf:label.task_terAnnouncer.email',
			'cshKey' => '_MOD_system_txschedulerM1',
			'cshLabel' => $fieldId
		);
		//templateRootPath
		$fieldName = 'tx_scheduler[jhTerAnnouncer_terAnnouncer_templateRootPath]';
		$fieldId = 'task_terAnnouncer_templateRootPath';
		$fieldHtml = '<input type="input" value="' . $value['templateRootPath'] . '" ' . 'name="' . $fieldName . '" ' . 'id="' . $fieldId . '" />';
		$additionalFields['task_terAnnouncer_templateRootPath'] = array(
			'code' => $fieldHtml,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang.xlf:label.task_terAnnouncer.templateRootPath',
			'cshKey' => '_MOD_system_txschedulerM1',
			'cshLabel' => $fieldId
		);
		return $additionalFields;
	}

	/**
	 * Validate additional fields
	 *
	 * @param array $submittedData Reference to the array containing the data submitted by the user
	 * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject Reference to the calling object (Scheduler's BE module)
	 * @return boolean True if validation was ok (or selected class is not relevant), false otherwise
	 */
	public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject) {
		$submittedData['jhTerAnnouncer_terAnnouncer_blacklist'] = trim($submittedData['jhTerAnnouncer_terAnnouncer_blacklist']);
		$submittedData['jhTerAnnouncer_terAnnouncer_email'] = trim($submittedData['jhTerAnnouncer_terAnnouncer_email']);
		$submittedData['jhTerAnnouncer_terAnnouncer_templateRootPath'] = trim($submittedData['jhTerAnnouncer_terAnnouncer_templateRootPath']);
		return TRUE;
	}

	/**
	 * Save additional field in task
	 *
	 * @param array $submittedData Contains data submitted by the user
	 * @param \TYPO3\CMS\Scheduler\Task\AbstractTask $task Reference to the current task object
	 * @return void
	 */
	public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task) {
		$task->blacklist = $submittedData['jhTerAnnouncer_terAnnouncer_blacklist'];
		$task->email = $submittedData['jhTerAnnouncer_terAnnouncer_email'];
		$task->templateRootPath = $submittedData['jhTerAnnouncer_terAnnouncer_templateRootPath'];
	}

}