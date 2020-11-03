<?php

########################################################################
# Extension Manager/Repository config file for ext "tidy".
#
# Auto generated 08-08-2015 20:54
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'HTML Tidy for the TYPO3 Frontend',
	'description' => 'Use HTML Tidy to clean up your HTML output.',
	'category' => 'fe',
	'shy' => 0,
	'version' => '1.0.5',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.0.0-7.6.99'
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Benjamin Mack',
	'author_email' => 'benni@typo3.org',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
);
