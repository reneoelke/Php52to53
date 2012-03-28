<?php
/**
 * Class Foobugs_PHP52to53_Sniffs_Deprecated_SetlocaleSniff.
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
 * This sniff searches for function setlocale() and checks for non-string category argument.
 *
 * For more details see http://www.php.net/manual/en/migration53.deprecated.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Foobugs_PHP52to53_Sniffs_Deprecated_SetlocaleSniff implements PHP_CodeSniffer_Sniff
{
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

		if ('setlocale' !== $token) {
			return;
		}
		
		$openParenthesisIndex = $phpcsFile->findNext(
			T_OPEN_PARENTHESIS,
			($stackPtr + 1)
		);
		$firstArgumentIndex = $phpcsFile->findNext(
			PHP_CodeSniffer_Tokens::$emptyTokens, //T_CONSTANT_ENCAPSED_STRING,
			($openParenthesisIndex + 1),
			null,
			true
		);

		if ('T_CONSTANT_ENCAPSED_STRING' === $tokens[$firstArgumentIndex]['type']) {
			$warning = sprintf(
				'Passing category as string to setlocale() is deprecated!',
				$token
			);
			$phpcsFile->addWarning($warning, $stackPtr);
		}
	}
}
