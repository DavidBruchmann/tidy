<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// fetch extension options and evaluate with existing TYPO3 Core options.
// Extension options take precedence over the existing TYPO3 Core options.
if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['tidy'])) {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tidy'] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['tidy']);
} else {
	$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tidy'] = array(
		'enable' => $GLOBALS['TYPO3_CONF_VARS']['FE']['tidy'],
		'option' => $GLOBALS['TYPO3_CONF_VARS']['FE']['tidy_option'],
		'path'   => $GLOBALS['TYPO3_CONF_VARS']['FE']['tidy_path']
	);
}

// activate the hook depending if Tidy is activated
if (!empty($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tidy']['enable'])) {
	switch ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tidy']['option']) {
		case 'output':
			$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['isOutputting']['tx_tidy'] = 'Bmack\\Tidy\\Hook\\Tidy->tidyOutputContent';
		case 'all':
			$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all']['tx_tidy'] = 'Bmack\\Tidy\\Hook\\Tidy->tidyAllContent';
		case 'cached':
			$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all']['tx_tidy'] = 'Bmack\\Tidy\\Hook\\Tidy->tidyCachedContent';
		break;
	}
}
