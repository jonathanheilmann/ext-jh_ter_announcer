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
class ResolveCategoryFromIntViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	
	/**
	 * @var array
	 */
	static protected $defaultCategories = array(
		0 => 'be',
		1 => 'module',
		2 => 'fe',
		3 => 'plugin',
		4 => 'misc',
		5 => 'services',
		6 => 'templates',
		8 => 'doc',
		9 => 'example',
		10 => 'distribution'
	);

	/**
	 * 
	 *
	 * @param int $category
	 * @return string Formatted category
	 */
	public function render($category = NULL) {
		if ($category === NULL) {
			$category = $this->renderChildren();
			if ($category === NULL) {
				return '';
			}
		}
		
		$categoryTitle = 'misc';
		if (\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($category)) {
			if (array_key_exists($category, self::$defaultCategories)) {
				$categoryTitle = self::$defaultCategories[$category];
			} else {
				$categoryTitle = 'misc';	
			}
		} else {
			$categoryTitle = htmlentities($category);	
		}
		return $categoryTitle;
		
	}
}
?>