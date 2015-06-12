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
	
	
	/*
	 * action initialize
	 * 
	 * @return void
	 */
	public function initializeAction() {
		// merge settings with flexform
		\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($this->settings, $this->mergeSettings($this->settings['flexform']));
		unset($this->settings['flexform']);
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings);
	}
	
	/*
	 * merge settings
	 * used to merge flexform setting with typoscript setting
	 *
	 * @param array $settings
	 * @return array
	 */
	private function mergeSettings($settings) {
		foreach($settings as $key => $value) {
			if (isset($value['select']) && $value['select'] == 'local') {
				$settings[$key] = $value['value'];
			} else if (!isset($value['select'])) {
				if (is_array($value)) {
					$settings[$key] = $this->mergeSettings($value);
				} else {
					$settings[$key] = $value;
				}
			} else {
				unset($settings[$key]);
			}
		}
		return $settings;
	}

	/**
	 * action list
	 *
	 * @param string $format
	 * @return void
	 */
	public function listAction($format = '') {
		$extensions = NULL;
		
		// get format
		if ($format != '') {
			$this->request->setFormat($format);
		} else {
			if ($this->settings['format'] != '') {
				$this->request->setFormat($this->settings['format']);
			}
		}
		
		// get filter
		$filtersString = $this->settings['filter'];
		
		// get limit
		$limit = NULL;
		if ($this->request->getFormat() == 'xml') {
			$limit = $this->settings['list']['rss']['config']['limit'];
		}
		
		// get extensions
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
					} else {
						$this->addFlashMessage('Unallowed propertyName \'' . $filterProperties[0] . '\' for filter', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
					}
				}
				$extensions = $this->extensionRepository->findByDemand($demand, $limit);
			} else {
				$this->addFlashMessage('Faulty filter!');
				$extensions = $this->extensionRepository->findByCurrentVersion(1, $limit);
			}
		} else {
			$extensions = $this->extensionRepository->findByCurrentVersion(1, $limit);
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