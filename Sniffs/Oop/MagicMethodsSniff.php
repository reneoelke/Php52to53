<?php
/**
 * Class Foobugs_PHP52to53_Sniffs_Oop_MagicMethodsSniff.
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
 * This sniff searches for magic methods and checks for non-static, public and
 * argument(s) declaration.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    René Oelke <rene.oelke@foobugs.com>
 * @copyright 2012 Foobugs
 * @license   BSD Licence
 * @version   $Id$
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Foobugs_PHP52to53_Sniffs_Oop_MagicMethodsSniff implements PHP_CodeSniffer_Sniff
{
	/**
	 * List with magic methods.
	 *
	 * @var array
	 */
	private $_methods = array(
		'__call',
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
		
		switch ($methodName) {
			case '__call':
				$this->_checkCall($phpcsFile, $stackPtr, $methodName, $methodProperties);
				break;
			case '__get':
				$this->_checkGet($phpcsFile, $stackPtr, $methodName, $methodProperties);
				break;
			case '__isset':
				$this->_checkIsset($phpcsFile, $stackPtr, $methodName, $methodProperties);
				break;
			case '__set':
				$this->_checkSet($phpcsFile, $stackPtr, $methodName, $methodProperties);
				break;
			case '__toString':
				$this->_checkToString($phpcsFile, $stackPtr, $methodName, $methodProperties);
				break;
			case '__unset':
				$this->_checkUnset($phpcsFile, $stackPtr, $methodName, $methodProperties);
				break;
			default:
				break;
		}
	}

	/**
	 * Checks the magic method __call.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param array                $methodProperties An array with method properties.
	 *
	 * @return void
	 */
	private function _checkCall(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, array $methodProperties)
	{
		$this->_checkStatic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkPublic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkArguments($phpcsFile, $stackPtr, $methodName, 2);
	}
	
	/**
	 * Checks the magic method __get.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param array                $methodProperties An array with method properties.
	 *
	 * @return void
	 */
	private function _checkGet(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, array $methodProperties)
	{
		$this->_checkStatic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkPublic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkArguments($phpcsFile, $stackPtr, $methodName, 1);
	}
	
	/**
	 * Checks the magic method __isset.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param array                $methodProperties An array with method properties.
	 *
	 * @return void
	 */
	private function _checkIsset(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, array $methodProperties)
	{
		$this->_checkStatic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkPublic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkArguments($phpcsFile, $stackPtr, $methodName, 1);
	}
	
	/**
	 * Checks the magic method __set.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param array                $methodProperties An array with method properties.
	 *
	 * @return void
	 */
	private function _checkSet(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, array $methodProperties)
	{
		$this->_checkStatic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkPublic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkArguments($phpcsFile, $stackPtr, $methodName, 2);
	}
	
	/**
	 * Checks the magic method __toString.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param array                $methodProperties An array with method properties.
	 *
	 * @return void
	 */
	private function _checkToString(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, array $methodProperties)
	{
		$this->_checkStatic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkPublic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkArguments($phpcsFile, $stackPtr, $methodName, 0);
	}
	
	/**
	 * Checks the magic method __unset.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param array                $methodProperties An array with method properties.
	 *
	 * @return void
	 */
	private function _checkUnset(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, array $methodProperties)
	{
		$this->_checkStatic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkPublic($phpcsFile, $stackPtr, $methodName, $methodProperties);
		$this->_checkArguments($phpcsFile, $stackPtr, $methodName, 1);
	}
	
	/**
	 * Checks if the method is static and adds a warning if so.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param array                $methodProperties An array with method properties.
	 *
	 * @return void
	 */
	private function _checkStatic(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, array $methodProperties)
	{
		// Warning for static declaration
		if (true === $methodProperties['is_static']) {
			$warning = sprintf(
				'Magic method "%s" should not be declared static!',
				$methodName
			);
			$phpcsFile->addWarning($warning, $stackPtr);
		}
	}

	/**
	 * Checks if the method is not public and adds a warning if so.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param array                $methodProperties An array with method properties.
	 *
	 * @return void
	 */
	private function _checkPublic(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, array $methodProperties)
	{
		// Warning for non-public declaration
		if ('public' !== $methodProperties['scope']) {
			$warning = sprintf(
				'Magic method "%s" should be declared public!',
				$methodName
			);
			$phpcsFile->addWarning($warning, $stackPtr);
		}
	}

	/**
	 * Checks the number of method arguments.
	 *
	 * @param PHP_CodeSniffer_File $phpcsFile        The file where the token was found.
	 * @param int                  $stackPtr         The position in the stack where
	 *                                               the token was found.
	 * @param string               $methodName       The name of the method.
	 * @param int                  $countArgs        Number of required arguments.
	 *
	 * @return void
	 */
	private function _checkArguments(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $methodName, $countArgs)
	{
		$methodArguments = $phpcsFile->getMethodParameters($stackPtr);
		
		// Warning for non-public declaration
		if ($countArgs !== count($methodArguments)) {
			$error = sprintf(
				'Wrong argument count of magic method "%s"! Must take exactly %d argument(s).',
				$methodName,
				$countArgs
			);
			$phpcsFile->addError($error, $stackPtr);
		}
	}
}
