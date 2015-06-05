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
# Table structure for table 'tx_jhterannouncer_domain_model_feed'
#
CREATE TABLE tx_jhterannouncer_domain_model_feed (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	ext_key varchar(255) DEFAULT '' NOT NULL,
	ext_title varchar(255) DEFAULT '' NOT NULL,
	ext_description varchar(255) DEFAULT '' NOT NULL,
	ext_version varchar(255) DEFAULT '' NOT NULL,
	ext_state varchar(255) DEFAULT '' NOT NULL,
	ext_author varchar(255) DEFAULT '' NOT NULL,
	ext_author_email varchar(255) DEFAULT '' NOT NULL,
	ext_author_company varchar(255) DEFAULT '' NOT NULL,
	ext_depends varchar(255) DEFAULT '' NOT NULL,
	ext_conflicts varchar(255) DEFAULT '' NOT NULL,
	ext_suggests varchar(255) DEFAULT '' NOT NULL,
	ext_last_upload_comment varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder