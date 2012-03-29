<?php
/**
 * Class PHP52to53_Sniffs_Extensions_MingSniff.
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
 * This sniff searches for constants and functions of the ming extension.
 *
 * The ming extension isn't a standard extension anymore. It's moved to PECL. For all ming
 * constants and functions see http://php.net/manual/en/book.ming.php.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class PHP52to53_Sniffs_Extensions_MingSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with all ming constants.
	 *
	 * @var array
	 */
	private $_constants = array(
		'MING_NEW',
		'MING_ZLIB',
		'SWFBUTTON_HIT',
		'SWFBUTTON_DOWN',
		'SWFBUTTON_OVER',
		'SWFBUTTON_UP',
		'SWFBUTTON_MOUSEUPOUTSIDE',
		'SWFBUTTON_DRAGOVER',
		'SWFBUTTON_DRAGOUT',
		'SWFBUTTON_MOUSEUP',
		'SWFBUTTON_MOUSEDOWN',
		'SWFBUTTON_MOUSEOUT',
		'SWFBUTTON_MOUSEOVER',
		'SWFFILL_RADIAL_GRADIENT',
		'SWFFILL_LINEAR_GRADIENT',
		'SWFFILL_TILED_BITMAP',
		'SWFFILL_CLIPPED_BITMAP',
		'SWFTEXTFIELD_HASLENGTH',
		'SWFTEXTFIELD_NOEDIT',
		'SWFTEXTFIELD_PASSWORD',
		'SWFTEXTFIELD_MULTILINE',
		'SWFTEXTFIELD_WORDWRAP',
		'SWFTEXTFIELD_DRAWBOX',
		'SWFTEXTFIELD_NOSELECT',
		'SWFTEXTFIELD_HTML',
		'SWFTEXTFIELD_ALIGN_LEFT',
		'SWFTEXTFIELD_ALIGN_RIGHT',
		'SWFTEXTFIELD_ALIGN_CENTER',
		'SWFTEXTFIELD_ALIGN_JUSTIFY',
		'SWFACTION_ONLOAD',
		'SWFACTION_ENTERFRAME',
		'SWFACTION_UNLOAD',
		'SWFACTION_MOUSEMOVE',
		'SWFACTION_MOUSEDOWN',
		'SWFACTION_MOUSEUP',
		'SWFACTION_KEYDOWN',
		'SWFACTION_KEYUP',
		'SWFACTION_DATA',
	);

	/**
	 * List with all ming functions.
	 *
	 * @var array
	 */
	private $_functions = array(
		'ming_keypress',
		'ming_setcubicthreshold',
		'ming_setscale',
		'ming_setswfcompression',
		'ming_useconstants',
		'ming_useswfversion',
	);

	/**
	 * List with all ming classes.
	 *
	 * @var array
	 */
	private $_classes = array(
		'SWFAction',
		'SWFBitmap',
		'SWFButton',
		'SWFDisplayItem',
		'SWFFill',
		'SWFFont',
		'SWFFontChar',
		'SWFGradient',
		'SWFMorph',
		'SWFMovie',
		'SWFPrebuiltClip',
		'SWFShape',
		'SWFSound',
		'SWFSoundInstance',
		'SWFSprite',
		'SWFText',
		'SWFTextField',
		'SWFVideoStream',
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
				'Use of ming extension constant "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === in_array($token, $this->_functions)) {
			$error = sprintf(
				'Use of ming extension function "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}

		if (true === in_array($token, $this->_classes)) {
			$error = sprintf(
				'Use of ming extension class "%s"! Extension moved to PECL.',
				$token
			);
			$phpcsFile->addError($error, $stackPtr);
		}
	}
}
