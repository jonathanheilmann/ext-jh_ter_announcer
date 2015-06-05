<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_jhterannouncer_domain_model_feed'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_jhterannouncer_domain_model_feed']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, ext_key, ext_title, ext_description, ext_version, ext_state, ext_author, ext_author_email, ext_author_company, ext_depends, ext_conflicts, ext_suggests, ext_last_upload_comment',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, ext_key, ext_title, ext_description, ext_version, ext_state, ext_author, ext_author_email, ext_author_company, ext_depends, ext_conflicts, ext_suggests, ext_last_upload_comment, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
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
				'foreign_table' => 'tx_jhterannouncer_domain_model_feed',
				'foreign_table_where' => 'AND tx_jhterannouncer_domain_model_feed.pid=###CURRENT_PID### AND tx_jhterannouncer_domain_model_feed.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'ext_key' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_key',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'ext_title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_description',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_version' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_version',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_state' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_state',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_author' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_author',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_author_email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_author_email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_author_company' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_author_company',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_depends' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_depends',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_conflicts' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_conflicts',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_suggests' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_suggests',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ext_last_upload_comment' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:jh_ter_announcer/Resources/Private/Language/locallang_db.xlf:tx_jhterannouncer_domain_model_feed.ext_last_upload_comment',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder