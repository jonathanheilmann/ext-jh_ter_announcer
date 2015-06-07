#
# Table structure for table 'tx_jhterannouncer_domain_model_log'
#
CREATE TABLE tx_jhterannouncer_domain_model_log (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	ext_key varchar(255) DEFAULT '' NOT NULL,
	ext_version varchar(255) DEFAULT '' NOT NULL,
	sent_announcement tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_extensionmanager_domain_model_extension'
#
CREATE TABLE tx_extensionmanager_domain_model_extension (

	tx_extbase_type varchar(255) DEFAULT '' NOT NULL,

);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder