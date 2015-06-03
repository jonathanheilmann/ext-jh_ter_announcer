<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'TER Announcer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jhterannouncer_domain_model_log', 'EXT:jh_ter_announcer/Resources/Private/Language/locallang_csh_tx_jhterannouncer_domain_model_log.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jhterannouncer_domain_model_log');
$GLOBALS['TCA']['tx_jhterannouncer_domain_model_log'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_log',
		'label' => 'ext_key',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',

		'enablecolumns' => array(

		),
		'searchFields' => 'ext_key,ext_version,sent_announcement,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Log.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_jhterannouncer_domain_model_log.gif',

		'hideTable' => 1
	),
);
