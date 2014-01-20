TYPO3 Extension Tidy
====================

Use the command line tool HTML Tidy to clean up your HTML output.

Introduction
------------

Clean your HTML output with the HTML Tidy tool.

Until TYPO3 CMS 6.1, the functionality to use the external tool HTML
 Tidy (see http://www.w3.org/People/Raggett/tidy/) to clean up
 invalid HTML was included in the TYPO3 CMS Core. The functionality
 was removed and is now included in this tiny extension that hooks
 into the Frontend rendering process.

The previous options

$TYPO3_CONF_VARS['FE']['tidy']
$TYPO3_CONF_VARS['FE']['tidy_option']
$TYPO3_CONF_VARS['FE']['tidy_path']

still work with this extension, but it is encouraged to use
the settings that come with the extension.

Read http://www.w3.org/People/Raggett/tidy/ to understand what HTML
tidy does.

Installation
------------

Install the extension from the TYPO3 Extension Repository and set
the options in the extension manager section of the TYPO3 Backend.
The options set there are overriding options set via TYPO3_CONF_VARS,
but the deprecated options still work as before.
Be sure to install HTML Tidy to your server and set the tidy path 
correctly.
As soon as the functionality is enabled, tidy should be run when
the frontend is rendered.


Credits
-------
Benni Mack created this extension as a replacement for the usage in 
the TYPO3 CMS Core.

The current development version can be found on
https://github.com/b13/t3ext-tidy
but please not that further active development for this extension is
currently not planned.
