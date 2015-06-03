<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_jhterannouncer_domain_model_log'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_jhterannouncer_domain_model_log']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, ext_key, ext_version, sent_announcement',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, ext_key, ext_version, sent_announcement, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_jhterannouncer_domain_model_log',
				'foreign_table_where' => 'AND tx_jhterannouncer_domain_model_log.pid=###CURRENT_PID### AND tx_jhterannouncer_domain_model_log.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'ext_key' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_log.ext_key',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'ext_version' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_log.ext_version',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'sent_announcement' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_log.sent_announcement',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		
	),
);
