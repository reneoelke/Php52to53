<?php
/**
 * Class PHP52to53_Sniffs_Extensions_FdfSniff.
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
 * This sniff searches for constants and functions of the fdf extension.
 *
 * The fdf extension isn't a standard extension anymore. It's moved to PECL. For all fdf
 * constants and functions see http://php.net/manual/en/book.fdf.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHP52to53_Sniffs_Extensions_FdfSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with all fdf constants.
	 *
	 * @var array
	 */
	private $_constants = array(
		'FDFValue',
		'FDFStatus',
		'FDFFile',
		'FDFID',
		'FDFFf',
		'FDFSetFf',
		'FDFClearFf',
		'FDFFlags',
		'FDFSetF',
		'FDFClrF',
		'FDFAP',
		'FDFAS',
		'FDFAction',
		'FDFAA',
		'FDFAPRef',
		'FDFIF',
		'FDFEnter',
		'FDFExit',
		'FDFDown',
		'FDFUp',
		'FDFFormat',
		'FDFValidate',
		'FDFKeystroke',
		'FDFCalculate',
		'FDFNormalAP',
		'FDFRolloverAP',
		'FDFDownAP',
	);

	/**
	 * List with all fdf functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'fdf_add_doc_javascript',
		'fdf_add_template',
		'fdf_close',
		'fdf_create',
		'fdf_enum_values',
		'fdf_errno',
		'fdf_error',
		'fdf_get_ap',
		'fdf_get_attachment',
		'fdf_get_encoding',
		'fdf_get_file',
		'fdf_get_flags',
		'fdf_get_opt',
		'fdf_get_status',
		'fdf_get_value',
		'fdf_get_version',
		'fdf_header',
		'fdf_next_field_name',
		'fdf_open_string',
		'fdf_open',
		'fdf_remove_item',
		'fdf_save_string',
		'fdf_save',
		'fdf_set_ap',
		'fdf_set_encoding',
		'fdf_set_file',
		'fdf_set_flags',
		'fdf_set_javascript_action',
		'fdf_set_on_import_javascript',
		'fdf_set_opt',
		'fdf_set_status',
		'fdf_set_submit_form_action',
		'fdf_set_target_frame',
		'fdf_set_value',
		'fdf_set_version',
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
				'Use of fdf extension constant "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === in_array($token, $this->_functions)) {
			$error = sprintf(
				'Use of fdf extension function "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}
	}
}
