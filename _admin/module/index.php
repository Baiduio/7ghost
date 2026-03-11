<?php
class index{
	function actionIndex(){
		header("Location:/_admin/?m=site&a=Index");
		exit();
		//include tpl('index');
	}
	
	function actionLogin(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$configObj = d('config');
			if (!$configObj) {
				die('配置文件加载失败');
			}
			if($configObj->get('password')==$_POST['password']){
				$_SESSION['Jzb6spHwTmm2LUkMPAk2H1uCRhoA']=true;
				header("Location:/_admin/?m=site&a=index");
				exit();
			}
			echo "密码错误";
		}
		// 确保编码正确
		header('Content-Type: text/html; charset=utf-8');
		include tpl('login');
	}
	
	function actionLogout(){
		unset($_SESSION['Jzb6spHwTmm2LUkMPAk2H1uCRhoA']);
		header("Location:/_admin");
		exit();
	}
}