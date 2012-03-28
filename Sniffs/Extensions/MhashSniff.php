<?php
/**
 * Class Foobugs_PHP52to53_Sniffs_Extensions_MhashSniff.
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
 * This sniff searches for constants and functions of the mhash extension.
 *
 * The mhash extension isn't a standard extension anymore. It's moved to PECL. For all mhash
 * constants and functions see http://php.net/manual/en/book.mhash.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Foobugs_PHP52to53_Sniffs_Extensions_MhashSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with all mhash constants.
	 *
	 * @var array
	 */
	private $_constants = array(
		'MHASH_ADLER32',
		'MHASH_CRC32',
		'MHASH_CRC32B',
		'MHASH_GOST',
		'MHASH_HAVAL128',
		'MHASH_HAVAL160',
		'MHASH_HAVAL192',
		'MHASH_HAVAL224',
		'MHASH_HAVAL256',
		'MHASH_MD2',
		'MHASH_MD4',
		'MHASH_MD5',
		'MHASH_RIPEMD128',
		'MHASH_RIPEMD256',
		'MHASH_RIPEMD320',
		'MHASH_SHA1',
		'MHASH_SHA192',
		'MHASH_SHA224',
		'MHASH_SHA256',
		'MHASH_SHA384',
		'MHASH_SHA512',
		'MHASH_SNEFRU128',
		'MHASH_SNEFRU256',
		'MHASH_TIGER',
		'MHASH_TIGER128',
		'MHASH_TIGER160',
		'MHASH_WHIRLPOOL',
	);

	/**
	 * List with all mhash functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'mhash_count',
		'mhash_get_block_size',
		'mhash_get_hash_name',
		'mhash_keygen_s2k',
		'mhash',
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
				'Use of mhash extension constant "%s"! Extension moved to PECL, use hash instead.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === in_array($token, $this->_functions)) {
			$error = sprintf(
				'Use of mhash extension function "%s"! Extension moved to PECL, use hash instead.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}
	}
}
