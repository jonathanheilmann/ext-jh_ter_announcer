.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _admin-manual:

Administrator Manual
====================


Installation
------------

To install the extension, perform the following steps:

#. Go to the Extension Manager
#. Install the extension




.. _admin-scheduler:

Scheduler
---------

#. Go to the Scheduler
#. Create a new Task
#. Select Task "TER Announcer" of extensions "jh_ter_announcer"
#. Set Frequency
#. The Blacklist is a comma-seperated list of extension that schould not be respected by the task. So they do not appear in mails.
#. Set the E-mail address the announcement schould be sent to. This could be a comma-sperated list of mail-addresses.
#. If you want to use your own fluid template for the mail, change "templateRootPath" to your own path. Default path is "EXT:jh_ter_announcer/Resources/Private/Templates/"
