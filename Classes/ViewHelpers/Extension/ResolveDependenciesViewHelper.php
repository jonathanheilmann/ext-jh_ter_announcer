<?php
namespace Heilmann\JhTerAnnouncer\ViewHelpers\Extension;

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
 * ViewHelper to ...
 */
class ResolveDependenciesViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	
	/**
	 * 
	 *
	 * @param string dependencies
	 * @param string $fields
	 * @return string Formatted dependencies
	 */
	public function render($dependencies = NULL, $fields="depends,conflicts,suggests") {
		$rendered = array();
		if ($dependencies === NULL) {
			$dependencies = $this->renderChildren();
			if ($dependencies === NULL) {
				return '';
			}
		}
		
		$arrayDependencies = unserialize($dependencies);
		$arrayFields = GeneralUtility::trimExplode(',', $fields);
		foreach ($arrayFields as $field) {
			if (isset($arrayDependencies[$field])) {
				$rendered[$field][] = $this->implodeDependencies($arrayDependencies[$field]);
			}		
		}
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($rendered, 'rendered');
		return $rendered;
		
	}
	
	/**
	 * Implode dependencies
	 * 
	 * @param array $dependencies
	 * @return array
	 */
	private function implodeDependencies($dependencies) {
		$depends = array();
		foreach ($dependencies as $key => $value) {
			if ($value === '') {
				$depends[] = $key;
			} else {
				$depends[] = $key.': '.$value;
			}
		}
		return $depends;
	}
}
?>