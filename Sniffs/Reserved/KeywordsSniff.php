<?php
/**
 * Class Foobugs_PHP52to53_Sniffs_Reserved_KeywordsSniff.
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
 * This sniff searches for reserved keywords which are new since PHP 5.3.
 *
 * For details see http://php.net/manual/en/reserved.keywords.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Foobugs_PHP52to53_Sniffs_Reserved_KeywordsSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with reserved compile-time constants.
	 *
	 * @var array
	 */
	private $_constants = array(
		'__DIR__',
		'__NAMESPACE__',
		'E_DEPRECATED',
		'E_USER_DEPRECATED',
		'PHP_MAXPATHLEN',
	);

	/**
	 * List with reserved functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'array_replace',
		'array_replace_recursive',
		'class_alias',
		'json_last_error',
		'lcfirst',
		'parse_ini_string',
		'preg_filter',
		'quoted_printable_encode',
		'stream_context_set_default',
		'stream_supports_lock',
	);

	/**
	 * List with reserved class methods.
	 *
	 * @var array
	 */
	private $_methods = array(
		'__callStatic',
		'__invoke',
	);
	
	/**
	 * List with reserved PHP keywords.
	 *
	 * @var array
	 */
	private $_keywords = array(
		'goto',
		'namespace',
		'use',
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
			T_DIR,
			T_GOTO,
			T_NAMESPACE,
			T_NS_C,
			T_STRING,
			T_USE,
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

		if (true === in_array($token, $this->_constants)) {
			$error = sprintf(
				'Use of reserved constant "%s"!',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === in_array($token, $this->_keywords)) {
			$error = sprintf(
				'Use of reserved keyword "%s"!',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === $phpcsFile->hasCondition($stackPtr, T_CLASS)) {
			if (true === in_array($token, $this->_methods)) {
				$error = sprintf(
					'Use of reserved member function "%s"!',
					$token
				);
				$phpcsFile->addError($error, $stackPtr);
			}
		} else {
			if (true === in_array($token, $this->_functions)) {
				$error = sprintf(
					'Use of reserved function "%s"!',
					$token
				);
				$phpcsFile->addError($error, $stackPtr);
			}
		}
	}
}
