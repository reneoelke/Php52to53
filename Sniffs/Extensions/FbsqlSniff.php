<?php
/**
 * Class PHP52to53_Sniffs_Extensions_FbsqlSniff.
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
 * This sniff searches for constants and functions of the fbsql extension.
 *
 * The fbsql extension isn't a standard extension anymore. It's moved to PECL. For all fbsql
 * constants and functions see http://php.net/manual/en/book.fbsql.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHP52to53_Sniffs_Extensions_FbsqlSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with all fbsql constants.
	 *
	 * @var array
	 */
	private $_constants = array(
		'FBSQL_ASSOC',
		'FBSQL_NUM',
		'FBSQL_BOTH',
		'FBSQL_LOCK_DEFERRED',
		'FBSQL_LOCK_OPTIMISTIC',
		'FBSQL_LOCK_PESSIMISTIC',
		'FBSQL_ISO_READ_UNCOMMITTED',
		'FBSQL_ISO_READ_COMMITTED',
		'FBSQL_ISO_REPEATABLE_READ',
		'FBSQL_ISO_SERIALIZABLE',
		'FBSQL_ISO_VERSIONED',
		'FBSQL_UNKNOWN',
		'FBSQL_STOPPED',
		'FBSQL_STARTING',
		'FBSQL_RUNNING',
		'FBSQL_STOPPING',
		'FBSQL_NOEXEC',
		'FBSQL_LOB_DIRECT',
		'FBSQL_LOB_HANDLE',
	);

	/**
	 * List with all fbsql functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'fbsql_affected_rows',
		'fbsql_autocommit',
		'fbsql_blob_size',
		'fbsql_change_user',
		'fbsql_clob_size',
		'fbsql_close',
		'fbsql_commit',
		'fbsql_connect',
		'fbsql_create_blob',
		'fbsql_create_clob',
		'fbsql_create_db',
		'fbsql_data_seek',
		'fbsql_database_password',
		'fbsql_database',
		'fbsql_db_query',
		'fbsql_db_status',
		'fbsql_drop_db',
		'fbsql_errno',
		'fbsql_error',
		'fbsql_fetch_array',
		'fbsql_fetch_assoc',
		'fbsql_fetch_field',
		'fbsql_fetch_lengths',
		'fbsql_fetch_object',
		'fbsql_fetch_row',
		'fbsql_field_flags',
		'fbsql_field_len',
		'fbsql_field_name',
		'fbsql_field_seek',
		'fbsql_field_table',
		'fbsql_field_type',
		'fbsql_free_result',
		'fbsql_get_autostart_info',
		'fbsql_hostname',
		'fbsql_insert_id',
		'fbsql_list_dbs',
		'fbsql_list_fields',
		'fbsql_list_tables',
		'fbsql_next_result',
		'fbsql_num_fields',
		'fbsql_num_rows',
		'fbsql_password',
		'fbsql_pconnect',
		'fbsql_query',
		'fbsql_read_blob',
		'fbsql_read_clob',
		'fbsql_result',
		'fbsql_rollback',
		'fbsql_rows_fetched',
		'fbsql_select_db',
		'fbsql_set_characterset',
		'fbsql_set_lob_mode',
		'fbsql_set_password',
		'fbsql_set_transaction',
		'fbsql_start_db',
		'fbsql_stop_db',
		'fbsql_table_name',
		'fbsql_tablename',
		'fbsql_username',
		'fbsql_warnings',
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
				'Use of fbsql extension constant "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === in_array($token, $this->_functions)) {
			$error = sprintf(
				'Use of fbsql extension function "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}
	}
}
