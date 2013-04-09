PHP52to53
=========

PHP52to53 is a collection of sniffs for [PHP_CodeSniffer](http://pear.php.net/PHP_CodeSniffer) that check an PHP 5.2 application for PHP 5.3 compatibility.

Features
--------

* Check for removed, deprecated or changed function, methods, constants etc. including stuff from removed or changed extensions
* Scan for usage of added, changed or removed parameters
* Search for removed ini-directives
* ..

Requirements
------------

* [PHP_CodeSniffer 1.3.6+](http://pear.php.net/PHP_CodeSniffer)

Installation
------------

* **Composer**

        Add `foobugs/php52to53` to the `require-dev` section of your composer.json and run `composer install`.
        CodeSniffer can now be accessed from `vendor/bin/phpcs`.

For the next two options make sure you’ve PHP_CodeSniffer installed. After that you can either put this standard into the PHP_CodeSniffer Standards directory located in your PEAR directory: (`pear/PHP/CodeSniffer/Standards`) or place the standard somewhere else and use it as standalone standard.

* **Download**
	
	Download the [zip master](https://github.com/foobugs/PHP52to53/zipball/master) from github and extract it in the PHP_CodeSniffer Standards directory.

* **Git-Clone-Install**

	This script will go to your PHP_CodeSniffer Standards directory and place a clone of PHP52to53 Standard inside of it:

        cd `pear config-get php_dir`/PHP/CodeSniffer/Standards
        git clone git://github.com/foobugs/PHP52to53.git

Usage
-----

### Installed standard

If you have this standard copied or cloned into the PHPCodeSniffer Standards directory the standard should be listed when calling:

	phpcs -i

If `PHP52to53` is listed there you’re ready to use this standard on any directory:

	phpcs --standard=PHP52to53 <source-path>

### External standard
	
If you did not put the Standard into PHP_CodeSniffers Standard directory you can specify the external location of the standard. Note that the path to the standard must be a full qualified path:

	phpcs -standard=/Users/frank/Downloads/PHP52to53/Standards/PHP52to53 <source-path>

You can find more options and arguments (f.i. ignoring files, extensions, memory limit) in the official [PHP_CodeSniffer Manual](http://pear.php.net/manual/en/package.php.php-codesniffer.php).


Participate!
------------
You can participate in this project by forking the [Repository](https://github.com/foobugs/PHP52to53) and push changes back to the project. Feel free to post issues or whishes in the [issue section](https://github.com/foobugs/PHP52to53/issues).

Credits
=======

This standard is the result of a cooperation with [Zend Technologies Ltd.](http://www.zend.com) 
to develop a PHP_CodeSniffer standard for the PHP 5.3 compatibility project. Thanks to Slavey 
Karadzhov from Zend for supporting and testing it.
