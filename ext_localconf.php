<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Heilmann.' . $_EXTKEY,
	'Extension',
	array(
		'Extension' => 'list, show, history',
		
	),
	// non-cacheable actions
	array(
		'Extension' => '',
		
	)
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

// Add TER Announcer task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Heilmann\\JhTerAnnouncer\\Task\\TerAnnouncerTask'] = array(
	'extension' => $_EXTKEY,
	'title' => 'TER Announcer',
	'description' => 'Announces new ext-versions',
	'additionalFields' => '\\Heilmann\\JhTerAnnouncer\\Task\\TerAnnouncerAdditionalFieldProvider'
);

// Add task to update from TER
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Heilmann\\JhTerAnnouncer\\Task\\UpdateFromTerTask'] = array(
	'extension' => $_EXTKEY,
	'title' => 'Update from TER',
	'description' => 'Update extension list from TER'
);