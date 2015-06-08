<?php
namespace Heilmann\JhTerAnnouncer\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
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
 * ExtensionController
 */
class ExtensionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * extensionRepository
	 *
	 * @var \Heilmann\JhTerAnnouncer\Domain\Repository\ExtensionRepository
	 * @inject
	 */
	protected $extensionRepository = NULL;

	/**
	 * @var string
	 */
	protected $propertyNameWhitelist = 'extensionKey,state,category,authorName,authorEmail,ownerusername,authorCompany,currentVersion';

	/**
	 * action list
	 *
	 * @param string $filtersString
	 * @param string $format
	 * @return void
	 */
	public function listAction($filter = '', $format = '') {
		$filtersString = $filter;
		if ($format != '') {
			$this->request->setFormat($format);
		} else {
			if ($this->settings['format'] != '') {
				$this->request->setFormat($this->settings['format']);
			}
		}
		$extensions = NULL;
		if ($filtersString == '') {
			$filtersString = $this->settings['defaultFilter'];
		}
		if ($filtersString != '') {
			$demand = array();
			$filtersArray = GeneralUtility::trimExplode(';', $filtersString, TRUE);
			if (!empty($filtersArray) && is_array($filtersArray)) {
				foreach ($filtersArray as $filterString) {
					$filterProperties = GeneralUtility::trimExplode(':', $filterString);
					if (GeneralUtility::inList($this->propertyNameWhitelist, $filterProperties[0]) === TRUE) {
						$demand[] = array(
							'propertyName' => $filterProperties[0],
							'operand' => $filterProperties[1]
						);
					}
				}
				//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($demand);
				$extensions = $this->extensionRepository->findByDemand($demand);
			} else {
				$this->addFlashMessage('Faulty filter!');
				$extensions = $this->extensionRepository->findByCurrentVersion(1);
			}
		} else {
			$extensions = $this->extensionRepository->findByCurrentVersion(1);
		}
		$this->view->assign('extensions', $extensions);
		$this->view->assign('pageId', $GLOBALS['TSFE']->id);
	}

	/**
	 * action show
	 *
	 * @param \Heilmann\JhTerAnnouncer\Domain\Model\Extension $extension
	 * @return void
	 */
	public function showAction(\Heilmann\JhTerAnnouncer\Domain\Model\Extension $extension) {
		$this->view->assign('extension', $extension);
	}

	/**
	 * action history
	 *
	 * @param \Heilmann\JhTerAnnouncer\Domain\Model\Extension $extension
	 * @return void
	 */
	public function historyAction(\Heilmann\JhTerAnnouncer\Domain\Model\Extension $extension) {
		$versions = $this->extensionRepository->findByExtensionKey($extension->getExtensionKey());
		$this->view->assign('versions', $versions);
		$this->view->assign('extension', $extension);
	}

}