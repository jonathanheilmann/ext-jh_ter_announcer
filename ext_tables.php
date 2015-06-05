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
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_jhterannouncer_domain_model_log.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_jhterannouncer_domain_model_feed', 'EXT:jh_ter_announcer/Resources/Private/Language/locallang_csh_tx_jhterannouncer_domain_model_feed.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_jhterannouncer_domain_model_feed');
$GLOBALS['TCA']['tx_jhterannouncer_domain_model_feed'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed',
		'label' => 'ext_key',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'ext_key,ext_title,ext_description,ext_version,ext_state,ext_author,ext_author_email,ext_author_company,ext_depends,ext_conflicts,ext_suggests,ext_last_upload_comment,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Feed.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_jhterannouncer_domain_model_feed.gif'
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder