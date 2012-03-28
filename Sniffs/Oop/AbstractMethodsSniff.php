<?php
/**
 * Class Foobugs_PHP52to53_Sniffs_Oop_AbstractMethodsSniff.
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
 * This sniff searches for abstract methods and checks for static or private declaration.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Foobugs_PHP52to53_Sniffs_Oop_AbstractMethodsSniff implements PHP_CodeSniffer_Sniff
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
			T_FUNCTION,
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

		// Only accept class member functions
		if (false === $phpcsFile->hasCondition($stackPtr, T_CLASS)) {
			return;
		}
		
		$nextTokenIndex = $phpcsFile->findNext(
			PHP_CodeSniffer_Tokens::$emptyTokens,
			($stackPtr + 1),
			null,
			true
		);
		$methodName = $tokens[$nextTokenIndex]['content'];
		
		$methodProperties = $phpcsFile->getMethodProperties($stackPtr);
		
		if (true === $methodProperties['is_abstract']) {
			// Warning for abstract static declared functions
			if (true === $methodProperties['is_static']) {
				$warning = sprintf(
					'Abstract function "%s" should not be declared static!',
					$methodName
				);
				$phpcsFile->addWarning($warning, $stackPtr);
			}

			// Error for static abstract declared functions
			if ('private' === $methodProperties['scope']) {
				$error = sprintf(
					'Abstract function "%s" can not be declared private!',
					$methodName
				);
				$phpcsFile->addError($error, $stackPtr);
			}
		}
	}
}
