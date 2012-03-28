<?php
/**
 * Class Foobugs_PHP52to53_Sniffs_Deprecated_FunctionsSniff.
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
 * This sniff searches for functions declared as deprecated (E_DEPRECATED error level).
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
class Foobugs_PHP52to53_Sniffs_Deprecated_FunctionsSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with deprecated functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'call_user_method',
		'call_user_method_array',
		'define_syslog_variables',
		'dl',
		'set_magic_quotes_runtime',
		'session_register',
		'session_unregister',
		'session_is_registered',
		'set_socket_blocking',
		'mysql_db_query',
		'mysql_escape_string',
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
				'Use of deprecated function "%s"!',
				$token
			);
			$phpcsFile->addError($warning, $stackPtr);
		}
	}
}
