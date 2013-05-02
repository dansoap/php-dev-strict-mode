<?php

error_reporting(E_ALL & E_STRICT);
ini_set('display_errors', 'stdout');

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

set_error_handler("exception_error_handler");