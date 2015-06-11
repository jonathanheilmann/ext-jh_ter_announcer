<?php
namespace Heilmann\JhTerAnnouncer\ViewHelpers\Extension;

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
class ResolveStateFromIntViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	
	/**
	 * @var array
	 */
	static protected $defaultStates = array(
		0 => 'alpha',
		1 => 'beta',
		2 => 'stable',
		3 => 'experimental',
		4 => 'test',
		5 => 'obsolete',
		6 => 'excludeFromUpdates',
		999 => 'n/a'
	);
	
	/**
	 * @var array
	 */
	static protected $defaultStateClasses = array(
		0 => 'alpha',
		1 => 'beta',
		2 => 'stable',
		3 => 'experimental',
		4 => 'test',
		5 => 'obsolete',
		6 => 'exclude-from-updates',
		999 => 'n-a'
	);

	/**
	 * 
	 *
	 * @param int $state
	 * @param boolean $addWrap
	 * @return string Formatted state
	 */
	public function render($state = NULL, $addWrap = FALSE) {
		if ($state === NULL) {
			$state = $this->renderChildren();
			if ($state === NULL) {
				return '';
			}
		}
		
		if (\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($state)) {
			if (array_key_exists($state, self::$defaultStates)) {
				$stateTitle = self::$defaultStates[$state];
			} else {
				$stateTitle = 'n/a';	
			}
		} else {
			$stateTitle = htmlentities($state);	
		}
		if ($addWrap === TRUE) {
			if (array_key_exists($state, self::$defaultStateClasses)) {
				$stateTitle = '<span class="'.self::$defaultStateClasses[$state].'">'.$stateTitle.'</span>';
			} else {
				$stateTitle = '<span class="n-a">'.$stateTitle.'</span>';
			}
		}
		return $stateTitle;
		
	}
}
?>