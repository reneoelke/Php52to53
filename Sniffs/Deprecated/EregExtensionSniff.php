<?php
/**
 * Class PHP52to53_Sniffs_Deprecated_EregExtensionSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * This sniff searches for functions of the deprecated ereg extension.
 *
 * For all ereg functions see http://php.net/manual/en/book.regex.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   Release 1.0
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHP52to53_Sniffs_Deprecated_EregExtensionSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with all deprecated ereg functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'ereg',
		'ereg_replace',
		'eregi',
		'eregi_replace',
		'split',
		'spliti',
		'sql_regcase',
	);

	/**
	 * A list of tokenizers this sniff supports.
	 *
	 * @var array
	 */
	public $supportedTokenizers = array(
		'PHP',
	);

	/**
	 * Returns the token types that this sniff is interested in.
	 *
	 * @return array(int)
	 * @see PHP_CodeSniffer_Sniff::register()
	 */
	public function register()
	{
		return array(
			T_STRING,
		);
	}

	/**
	 * Processes the tokens that this sniff is interested in.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile The file where the token was found.
	 * @param int                  $stackPtr  The position in the stack where
	 *                                        the token was found.
	 *
	 * @return void
	 * @see PHP_CodeSniffer_Sniff::process()
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		$token = $tokens[$stackPtr]['content'];
		if (true === in_array($token, $this->_functions)) {
			$warning = sprintf(
				'Use of deprecated ereg extension function "%s"!',
				$token
			);
			$phpcsFile->addWarning($warning, $stackPtr);
		}
	}
}
