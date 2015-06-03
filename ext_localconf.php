<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}
// Add TER Announcer task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Heilmann\\JhTerAnnouncer\\Task\\TerAnnouncerTask'] = array(
	'extension' => $_EXTKEY,
	'title' => 'TER Announcer',
	'description' => 'Announces new ext-versions',
	'additionalFields' => '\\Heilmann\\JhTerAnnouncer\\Task\\TerAnnouncerAdditionalFieldProvider'
);