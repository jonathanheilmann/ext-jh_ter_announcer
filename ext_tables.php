<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Extension',
	'Extension'
);

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

if (!isset($GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['ctrl']['type'])) {
	if (file_exists($GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['ctrl']['dynamicConfigFile'])) {
		require_once($GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['ctrl']['dynamicConfigFile']);
	}
	// no type field defined, so we define it here. This will only happen the first time the extension is installed!!
	$GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['ctrl']['type'] = 'tx_extbase_type';
	$tempColumns = array();
	$tempColumns[$GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['ctrl']['type']] = array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer.tx_extbase_type',
		'config' => array(
			'type' => 'select',
			'items' => array(),
			'size' => 1,
			'maxitems' => 1,
		)
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_extensionmanager_domain_model_extension', $tempColumns, 1);
}

$GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['types']['Tx_JhTerAnnouncer_Extension']['showitem'] = $TCA['tx_extensionmanager_domain_model_extension']['types']['0']['showitem'];
$GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['types']['Tx_JhTerAnnouncer_Extension']['showitem'] .= ',--div--;LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_extension,';
$GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['types']['Tx_JhTerAnnouncer_Extension']['showitem'] .= '';

$GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['columns'][$TCA['tx_extensionmanager_domain_model_extension']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_extensionmanager_domain_model_extension.tx_extbase_type.Tx_JhTerAnnouncer_Extension','Tx_JhTerAnnouncer_Extension');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_extensionmanager_domain_model_extension', $GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['ctrl']['type'],'','after:' . $TCA['tx_extensionmanager_domain_model_extension']['ctrl']['label']);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

// Hide log table in web_list
$GLOBALS['TCA']['tx_extensionmanager_domain_model_extension']['ctrl']['hideTable'] = true;

// Add FlexForms
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_extension';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_extension.xml');