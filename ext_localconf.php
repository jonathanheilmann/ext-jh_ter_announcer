<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Heilmann.' . $_EXTKEY,
	'Extension',
	array(
		'Extension' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Extension' => '',
		
	)
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder