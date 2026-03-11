<?php
// 检测 PHP 版本
if (version_compare(PHP_VERSION, '8.1', '<')) {
    define('PHP_VERSION_OLD', true);
} else {
    define('PHP_VERSION_OLD', false);
}

error_reporting(E_ALL & ~ E_NOTICE );
define('ADIR', str_replace("\\", "/", dirname(__FILE__)).'/');
require ADIR.'includes/Snoopy.class.php';
require ADIR.'includes/function.php';
	
