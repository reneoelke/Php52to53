<?php
/**
 * Class PHP52to53_Sniffs_Deprecated_RuntimeReferencesSniff.
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
 * This sniff searches for deprecated runtime references.
 *
 * An example of a runtime reference is:
 *
 * <code>
 *  function test($a)
 *  {
 *      $a++;
 *  }
 *
 *  $a = 42;
 *  test(&$a);
 * </code>
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHP52to53_Sniffs_Deprecated_RuntimeReferencesSniff implements PHP_CodeSniffer_Sniff
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
			T_BITWISE_AND,
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
		// Ignore normal references
		if (true === $phpcsFile->isReference($stackPtr)) {
			return;
		}

		// Ignore all but variables
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr + 1];
		if (T_VARIABLE !== $token['code']) {
			return;
		}

		$warning = sprintf(
			'Use of deprecated runtime references for variable "%s"!',
			$token['content']
		);
		$phpcsFile->addWarning($warning, $stackPtr);
	}
}
