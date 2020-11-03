<?php

namespace Bmack\Tidy\Hook;

/*
 * This file is part of TYPO3 CMS-based extension "tidy" by Benjamin Mack.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

class Tidy {


	/**
	 * hook to be called to tidy-fy the content before the content is stored in the cache
	 * note: this might conflict if having $TSFE->doXHTML_cleaning() and / or
	 * $TSFE->doLocalAnchorFix() set to "all" as well.
	 *
	 * @param array $parameters
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $tsfe
	 */
	public function tidyAllContent($parameters, $tsfe) {
		$tsfe->content = $this->execute($tsfe->content);
	}


	/**
	 * hook to be called to tidy-fy the content before the content is stored in the cache
	 * note: this only applies to the page content if the content is cacheable
	 *
	 * @param array $parameters
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $tsfe
	 */
	public function tidyCachedContent($parameters, $tsfe) {
		if (!$tsfe->no_cache) {
			$tsfe->content = $this->execute($tsfe->content);
		}
	}


	/**
	 * hook to be called to tidy-fy the content if content is outputted
	 *
	 * @param array $parameters
	 * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $tsfe
	 */
	public function tidyOutputContent($parameters, $tsfe) {
		if ($parameters->enableOutput) {
			$tsfe->content = $this->execute($tsfe->content);
		}
	}


	/**
	 * Pass the content through tidy - a little program that cleans up HTML-code.
	 * Requires the tidy path to be set to
	 * contain the filename/path of tidy including clean-up arguments for tidy.
	 * See README.md in this extension
	 *
	 * @param string $content The page content to clean up. Will be written to a temporary file which "tidy" is then asked to clean up. File content is read back and returned.
	 * @return string Returns the modified content
	 */
	protected function execute($content) {
		if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tidy']['path']) {
			$oldContent = $content;
			// Create temporary name
			$fname = \TYPO3\CMS\Core\Utility\GeneralUtility::tempnam('typo3_tidydoc_');
			// Delete if exists, just to be safe.
			@unlink($fname);
			// Open for writing
			$fp = fopen($fname, 'wb');
			// Put $content
			fputs($fp, $content);
			// Close
			@fclose($fp);
			// run the $content through 'tidy', which formats the HTML to nice code.
			exec($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tidy']['path'] . ' ' . $fname, $output);
			// Delete the tempfile again
			@unlink($fname);
			$content = implode(LF, $output);
			if (!trim($content)) {
				// Restore old content due empty return value.
				$content = $oldContent;
			}
		}
		return $content;
	}

}
