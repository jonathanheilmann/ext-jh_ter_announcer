<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "jh_ter_announcer".
 *
 * Auto generated 12-08-2014 20:15
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'TER Announcer',
	'description' => 'Provides a task to send you a mail if an extension-update is available.',
	'category' => 'services',
	'version' => '0.1.0-dev',
	'state' => 'beta',
	'uploadfolder' => true,
	'createDirs' => '',
	'clearcacheonload' => true,
	'author' => 'Jonathan Heilmann',
	'author_email' => 'mail@jonathan-heilmann.de',
	'author_company' => '',
	'constraints' =>
	array (
		'depends' =>
		array (
			'typo3' => '6.2.0 - 6.2.99',
		),
		'conflicts' =>
		array (
		),
		'suggests' =>
		array (
		),
	),
);

