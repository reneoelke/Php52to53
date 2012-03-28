<?php
/**
 * Class Foobugs_PHP52to53_Sniffs_Extensions_SybaseSniff.
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
 * This sniff searches for constants and functions of the sybase extension.
 *
 * The sybase extension isn't a standard extension anymore. It's moved to PECL. For all sybase
 * constants and functions see http://php.net/manual/en/book.sybase.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Foobugs_PHP52to53_Sniffs_Extensions_SybaseSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with all sybase constants.
	 *
	 * @var array
	 */
	private $_constants = array(
	);

	/**
	 * List with all sybase functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'sybase_affected_rows',
		'sybase_close',
		'sybase_connect',
		'sybase_data_seek',
		'sybase_deadlock_retry_count',
		'sybase_fetch_array',
		'sybase_fetch_assoc',
		'sybase_fetch_field',
		'sybase_fetch_object',
		'sybase_fetch_row',
		'sybase_field_seek',
		'sybase_free_result',
		'sybase_get_last_message',
		'sybase_min_client_severity',
		'sybase_min_error_severity',
		'sybase_min_message_severity',
		'sybase_min_server_severity',
		'sybase_num_fields',
		'sybase_num_rows',
		'sybase_pconnect',
		'sybase_query',
		'sybase_result',
		'sybase_select_db',
		'sybase_set_message_handler',
		'sybase_unbuffered_query',
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

		if (true === in_array($token, $this->_constants)) {
			$error = sprintf(
				'Use of sybase extension constant "%s"! Extension moved to PECL, use sybase_ct instead.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === in_array($token, $this->_functions)) {
			$error = sprintf(
				'Use of sybase extension function "%s"! Extension moved to PECL, use sybase_ct instead.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}
	}
}
