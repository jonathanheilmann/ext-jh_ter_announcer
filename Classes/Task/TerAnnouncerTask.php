<?php
namespace Heilmann\JhTerAnnouncer\Task;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Jonathan Heilmann <mail@jonathan-heilmann.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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

use \TYPO3\CMs\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * Send an announcement if a new extension version is available.
 *
 * Parts: Copyright (C) 2013 Tobias Liebig <tobias.liebig@typo3.org>
 * https://github.com/etobi/Typo3ExtensionUtils
 *
 * @author Jonathan Heilmann <mail@jonathan-heilmann.de>
 */
class TerAnnouncerTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
	 * @var object
	 */
	public $objectManager = NULL;

	/**
	 * @var object
	 */
	protected $configurationManager = NULL;

	/**
	 * @var string
	 */
	private $extensionsXmlFolderPath = 'uploads/tx_jhterannouncer/';

	/**
	 * @var string
	 */
	private $extensionsXmlFileName = 'extensions.xml';

	/**
	 * @var string
	 */
	private $extensionsXmlFile = '';

	/**
	 * Execute TER announcer.
	 * Parts: Copyright (C) 2013 Tobias Liebig <tobias.liebig@typo3.org>
	 *
	 * @return boolean TRUE if task run was successful
	 */
	public function execute() {
		$this->objectManager = GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Object\ObjectManager');
		$this->configurationManager = $this->objectManager->get('TYPO3\CMS\Extbase\Configuration\ConfigurationManager');
		$logRepository = $this->objectManager->get('\Heilmann\JhTerAnnouncer\Domain\Repository\LogRepository');
		$persistenceManager = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface');
		$this->extensionsXmlFile = GeneralUtility::getFileAbsFileName($this->extensionsXmlFolderPath . $this->extensionsXmlFileName);

		// get a list of local and global installed extensions
		$extensionList = $this->getExtensionList();

		$xpath = NULL;
		$xpath = $this->queryExtensionsXML('');
		if(empty($xpath)) {return FALSE;}
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($xpath);

		foreach($extensionList as $extKey => $properties) {
			// Find latest version of extension
			$result = $xpath->query('/extensions/extension[@extensionkey="' . $extKey . '"]');
			if(empty($result->item(0)->childNodes)) continue; //occures if a extension is not available in TER
			$max = -1;
			$version = NULL;
			foreach ($result->item(0)->childNodes as $versionNode) {
				if ($versionNode->nodeName == 'version' && $versionNode->hasAttribute('version')) {
					$date = $versionNode->getElementsByTagName('lastuploaddate')->item(0)->nodeValue;
					if($date > $max) {
						$max = $date;
						$version = $versionNode->getAttribute('version');
					}
				}
			}
			if ($version) {
				// Found latest version of extension
				$terVersion = VersionNumberUtility::convertVersionNumberToInteger($version);
				$localVersion = VersionNumberUtility::convertVersionNumberToInteger($properties['version']);
				if ($terVersion > $localVersion) {
					// Found new version of extension in TER -> chick if it has been logged and if an announcement has been sent
					$log = $logRepository->findByExtKeyAndExtVersion($extKey, $terVersion)->getFirst();
					if (count($log) == 0 || $log->getSentAnnouncement() === FALSE) {
						// create array with extensions-properties
						$updateableExt[$extKey] = array(
							'terVersion' => $version,
							'terVersionInt' => $terVersion,
							'installedVersion' => $properties['version'],
							'installedVersionInt' => $localVersion
						);
						if (count($log) == 0) {
							// create new log-entry
							$newLog = $this->objectManager->get('Heilmann\JhTerAnnouncer\Domain\Model\Log');
							$newLog->setExtKey($extKey);
							$newLog->setExtVersion($terVersion);
							$newLog->setPid('1');
							$logRepository->add($newLog);
						}
					}
				}
			}
		}
		// save new log-entries
		$persistenceManager->persistAll();

		if (!empty($updateableExt)) {
			//send mail
			$sentMail = $this->sendMail($updateableExt);

			// if mail has been sent: update field sentAnnouncement
			if ($sentMail === TRUE) {
				foreach ($updateableExt as $extKey => $info){
					$log = $logRepository->findByExtKeyAndExtVersion($extKey, $info['terVersionInt'])->getFirst();
					if(empty($log)) continue;
					$log->setSentAnnouncement(TRUE);
					$logRepository->update($log);
				}
				// save updated log-entries
				$persistenceManager->persistAll();
			}
		}

		return TRUE;
	}

	/**
	 * Create an array of loaded and local/global extensions that are not blacklisted
	 *
	 * @return array
	 */
	private function getExtensionList() {
		$extensions = array();
		$blacklistArray = GeneralUtility::trimExplode(',', $this->blacklist, TRUE);
		foreach ($GLOBALS['TYPO3_LOADED_EXT'] as $extKey => $properties) {
			// skip System-Extensions
			if ($properties['type'] == 'S') continue;
			// skip extensions from blacklist
			if (in_array($extKey, $blacklistArray)) continue;
			$extensions[$extKey] = array(
				'key' => $extKey,
				'type' => $properties['type'],
				'installed' => TRUE,
				'siteRelPath' => $properties['siteRelPath']
			);
			$emConf = \TYPO3\CMS\Extensionmanager\Utility\EmConfUtility::includeEmConf($extensions[$extKey]);
			$extensions[$extKey]['version'] = $emConf['version'];
			//remove extension from list if no version is available (occures if the admin deletes the extension folder manaually)
			if (empty($extensions[$extKey]['version'])) unset($extensions[$extKey]);
		}
		return $extensions;

		/**
		 * alternative:
		 * get list of local/global extensions that are not blacklisted
		 * includes unloaded extensions!
		 */
		/*
		$paths = \TYPO3\CMS\Extensionmanager\Domain\Model\Extension::returnInstallPaths();
		foreach ($paths as $installationType => $path) {
			try {
				if (is_dir($path) && $installationType != 'System') {
					$extList = GeneralUtility::get_dirs($path);
					if (is_array($extList)) {
						foreach ($extList as $extKey) {
							// skip extensions from blacklist
							if (in_array($extKey, $blacklistArray)) continue;
							// render extension-info
							$emConf = \TYPO3\CMS\Extensionmanager\Utility\EmConfUtility::includeEmConf($extensions[$extKey]);
							$extensions[$extKey] = array(
								'siteRelPath' => str_replace(PATH_site, '', $path . $extKey) . '/',
								'type' => $installationType,
								'key' => $extKey,
								'version' => $emConf['version']
							);
						}
					}
				}
			} catch (\Exception $e) {
				GeneralUtility::sysLog($e->getMessage(), 'jh_ter_announcer');
			}
		}
		return $extensionList;
		*/
	}

	/**
	 * queryExtensionsXML
	 * Copyright (C) 2013 Tobias Liebig <tobias.liebig@typo3.org>
	 *
	 * query extension xml
	 *
	 * @param $query xpath query
	 * @returns DOMXPath
	 */
	protected function queryExtensionsXML($query) {
		if (!file_exists($this->extensionsXmlFile) || (time() - filemtime($this->extensionsXmlFile)) > 3600) {
			$resultUpdateAction = $this->updateAction();
		}

		if (file_exists($this->extensionsXmlFile)) {
			$doc = new \DOMDocument();
			$doc->loadXML(file_get_contents($this->extensionsXmlFile));
			$xpath = new \DOMXpath($doc);
			return $xpath;
		} else {
			$GLOBALS['BE_USER']->simplelog('Could not open filepath "' . $this->extensionsXmlFile . '"', 'jh_terannouncer', '1');
			if ($resultUpdateAction === FALSE)
				$GLOBALS['BE_USER']->simplelog('GeneralUtility::mkdir failed. Path: "' . GeneralUtility::getFileAbsFileName($this->extensionsXmlFolderPath), 'jh_terannouncer', '1');
			return NULL;
		}
	}

	/**
	 * Fetches the extensionlist from TER
	 *
	 * Copyright (C) 2013 Tobias Liebig <tobias.liebig@typo3.org>
	 *
	 * @return boolean
	 */
	public function updateAction() {
		$is_dir = TRUE;
		if (!file_exists($this->extensionsXmlFolderPath)) {
			$is_dir = GeneralUtility::mkdir(GeneralUtility::getFileAbsFileName($this->extensionsXmlFolderPath));
		}
		if ($is_dir === TRUE) {
			$url = 'http://typo3.org/fileadmin/ter/extensions.xml.gz';
			exec('wget "' . $url . '" -q -O - | gunzip > ' . $this->extensionsXmlFile);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Sends a mail to given recievers with a list of new extensions
	 *
	 * @param $updateableExt array
	 * @return boolean
	 */
	private function sendMail($updateableExt) {
		$from['email'] = 'donotreply@' . GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY');
		$from['name'] = 'jh_ter_announcer';
		$subj = 'TER Announcer from ' . GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY');

		// render body with fluid
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
		$emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

		$templateRootPath = (GeneralUtility::getFileAbsFileName($this->templateRootPath) ?
			GeneralUtility::getFileAbsFileName($this->templateRootPath) : 'EXT:jh_ter_announcer/Resources/Private/Templates/');
		$templatePathAndFilename = $templateRootPath . 'Email/TerAnnouncerEmail.html';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assign('extlist', $updateableExt);
		$emailBody = $emailView->render();

		$mailContent = "Hello,\n\nthere are one ore more extension-update(s) available:\n\n";
		foreach ($updateableExt as $ext => $info) {
			$mailContent .= $ext . ' -> installed: ' . $info['installedVersion'] . ' -> available: ' . $info['terVersion'] . "\n";
		}
		$receivers = $this->explodeEmail($this->email);
		$sentMail = TRUE;
		// send email to each receiver
		foreach ($receivers as $receiver) {
			/** @var $message \TYPO3\CMS\Core\Mail\MailMessage */
			$message = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
			$message->setFrom(array($from['email'] => $from['name']))
						->setTo(array($receiver['email'] => $receiver['name']))
						->setSubject($subj)
						->setBody(trim($emailBody), 'text/plain', 'utf-8')
						->send();
			if (!$message->isSent()) $sentMail = FALSE;
		}

		return $sentMail;
	}

	/**
	 * explode comma seperated list of emails
	 *
	 * explodes a comma seperated list of emails like
	 * Name <mail@server.com>, mail@server.de
	 * to
	 * array(
	 * 	0 => array(
	 *			name => Name,
	 *			email => mail@server.com
	 * 	),
	 *		1 => array(
	 *			email => mail@server.de
	 * 	)
	 * )
	 *
	 * @return array
	 */
	private function explodeEmail($emailsCommaList) {
		$emails = GeneralUtility::trimExplode(',', $emailsCommaList);
		$res = array();
		foreach ($emails as $key => $email) {
			$array = GeneralUtility::trimExplode(' ', $email);
			if (count($array) > 1) {
				$i = 0;
				while ($i < (count($array) - 1)) {
					$res[$key]['name'] .= ' ' . $array[$i];
					$i++;
				}
				$res[$key]['email'] = str_replace(array('<','>'), '', $array[$i++]);
			} else {
				$res[$key]['email'] = $email;
			}
		}
		return $res;
	}

	/**
	 * This method returns additional information
	 *
	 * @return string Information to display
	 */
	public function getAdditionalInformation() {
		return $message;
	}

}
