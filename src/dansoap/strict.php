<?php

use dansoap\phpDevStrictMode as phpDevStrictMode;

// error_reporting(E_ALL & E_STRICT & E_DEPRECATED);
error_reporting(-1);
// ini_set('display_errors', 'stdout');



set_error_handler(
	function ($errno, $errstr, $errfile, $errline) {
		phpDevStrictMode\Strict::errorExceptionHandler($errno, $errstr, $errfile, $errline);
	}
);

set_exception_handler(
	function ($exception) {
		phpDevStrictMode\Strict::exceptionHandler($exception);
	}
);
