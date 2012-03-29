<?php
/**
 * Class PHP52to53_Sniffs_Extensions_MsqlSniff.
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
 * This sniff searches for constants and functions of the msql extension.
 *
 * The msql extension isn't a standard extension anymore. It's moved to PECL. For all msql
 * constants and functions see http://php.net/manual/en/book.msql.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHP52to53_Sniffs_Extensions_MsqlSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with all msql constants.
	 *
	 * @var array
	 */
	private $_constants = array(
		'MSQL_ASSOC',
		'MSQL_NUM',
		'MSQL_BOTH',
	);

	/**
	 * List with all msql functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'msql_affected_rows',
		'msql_close',
		'msql_connect',
		'msql_create_db',
		'msql_createdb',
		'msql_data_seek',
		'msql_db_query',
		'msql_dbname',
		'msql_drop_db',
		'msql_error',
		'msql_fetch_array',
		'msql_fetch_field',
		'msql_fetch_object',
		'msql_fetch_row',
		'msql_field_flags',
		'msql_field_len',
		'msql_field_name',
		'msql_field_seek',
		'msql_field_table',
		'msql_field_type',
		'msql_fieldflags',
		'msql_fieldlen',
		'msql_fieldname',
		'msql_fieldtable',
		'msql_fieldtype',
		'msql_free_result',
		'msql_list_dbs',
		'msql_list_fields',
		'msql_list_tables',
		'msql_num_fields',
		'msql_num_rows',
		'msql_numfields',
		'msql_numrows',
		'msql_pconnect',
		'msql_query',
		'msql_regcase',
		'msql_result',
		'msql_select_db',
		'msql_tablename',
		'msql',
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
				'Use of msql extension constant "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === in_array($token, $this->_functions)) {
			$error = sprintf(
				'Use of msql extension function "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}
	}
}
