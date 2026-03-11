<?php
	header('Content-Type: text/html; charset=utf8');
	/**
	 * 入口文件
	 */
	//error_reporting(0);
	$_GET['m'] = empty($_GET['m'])?'index':$_GET['m'];
	 //判断类型
	$initFile = dirname(__FILE__).'/init.php';
	if (!file_exists($initFile)) {
		die('初始化文件不存在: ' . $initFile);
	}
	include_once ($initFile);
	if (!defined('ADIR')) {
		die('ADIR 常量未定义');
	}
	if(!ctype_alnum($_GET['m'])){
		echo 'm error';exit;
	}
	session_start();
	//判断是否登录
	if(empty($_SESSION['Jzb6spHwTmm2LUkMPAk2H1uCRhoA'])){
		include (dirname(__FILE__).'/module/index.php');
		$m = new index();
		$m->actionLogin();
		exit();
	}
	if(@include (dirname(__FILE__).'/module/'.$_GET['m'].'.php')){
		$m = new $_GET['m']();
	 	$a = empty($_GET['a'])?'actionIndex':'action'.$_GET['a'];
	 	$m->$a();
	}