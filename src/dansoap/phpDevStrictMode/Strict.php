<?php

namespace dansoap\phpDevStrictMode;

class Strict {
	
	public static function errorExceptionHandler($errno, $errstr, $errfile, $errline) {
		
		self :: outputError($errno, $errstr, $errfile, $errline);
		
	}
	
	public static function exceptionHandler(\Exception $e) {
		
		self :: outputError(E_ERROR, 'Uncaught Exception', $e->getFile(), $e->getLine());
		
	}
	
	protected static function outputError($errno, $errstr, $errfile, $errline) {
		
		$errorLevel = self :: getErrorLevel($errno);
		
		if (php_sapi_name() == 'cli') {
			self :: outputErrorCli($errorLevel, $errstr, $errfile, $errline);
		} else {
			self :: outputErrorWeb($errorLevel, $errstr, $errfile, $errline);
		}
		
		die(-1);
	}
	
	protected static function outputErrorCli($errorLevel, $errstr, $errfile, $errline) {
		
		printf("Error of type %s occured:\n\t%s\n\tin %s on line %s\n", $errorLevel, $errstr, $errfile, $errline);
		debug_print_backtrace();
		
	} 
	
	protected static function outputErrorWeb($errorLevel, $errstr, $errfile, $errline) {
		
		ob_clean();
		printf("<h1>Error of type %s occured:</h1>\n\t%s\n\tin %s on line %s\n", $errorLevel, $errstr, $errfile, $errline);
		debug_print_backtrace();
		
	}
	
	
	protected static function getErrorLevel($errno) {
		$constants = get_defined_constants();
		$errorConstants = array();
		foreach ($constants as $key => $value) {
			if (substr($key, 0, 2) == 'E_') {
				$errorConstants[$value] = $key;
			}
		}
		ksort($errorConstants);
		
		foreach ($errorConstants as $mask => $value) {
			if ($errno == $mask)
				return $value;
		}
	}
	
}