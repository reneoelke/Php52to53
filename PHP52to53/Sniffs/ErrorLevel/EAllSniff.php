<?php
/**
 * Class PHP52to53_Sniffs_ErrorLevel_EAllSniff.
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
 * This sniff checks for setting error reporting level at runtime.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHP52to53_Sniffs_ErrorLevel_EAllSniff implements PHP_CodeSniffer_Sniff
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

		if ('error_reporting' !== $token) {
			return;
		}
		
		$openParenthesisIndex = $phpcsFile->findNext(
			T_OPEN_PARENTHESIS,
			($stackPtr + 1)
		);
		$firstArgumentIndex = $phpcsFile->findNext(
			PHP_CodeSniffer_Tokens::$emptyTokens,
			($openParenthesisIndex + 1),
			null,
			true
		);

		// Error level value for E_ALL under PHP 5.2 is 6143
		if ('6143' === $tokens[$firstArgumentIndex]['content']) {
			$warning = sprintf(
				'Error reporting value for E_ALL changed!',
				$token
			);
			$phpcsFile->addWarning($warning, $stackPtr);
		}
	}
}
