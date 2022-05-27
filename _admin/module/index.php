<?php
class index{
	function actionIndex(){
		header("Location:/_admin/?m=site&a=Index");
		exit();
		//include tpl('index');
	}
	
	function actionLogin(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			if(d('config')->get('password')==$_POST['password']){
				$_SESSION['Jzb6spHwTmm2LUkMPAk2H1uCRhoA']=true;
				header("Location:/_admin/?m=site&a=index");
				exit();
			}
			echo "密码错误";
		}
		include tpl('login');
	}
	
	function actionLogout(){
		unset($_SESSION['Jzb6spHwTmm2LUkMPAk2H1uCRhoA']);
		header("Location:/_admin");
		exit();
	}
}