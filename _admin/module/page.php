<?php
class page{
	function actionIndex(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setPage();
		}
		$item = array();
		include tpl('pageList');
	}
		
	function actionEdit(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setPage();
			header("Location:./?m=page&a=Index");
		}
		
		$key = isset($_GET['key']) && is_numeric($_GET['key']) ? $_GET['key'] : '';
		$item = array();
		if($key){
			$pages = d('config')->get('pages');
			$item = isset($pages[$key]) ? $pages[$key] : array();
		}
		include tpl('editPage');
	}
	
	function actionDel(){
		if(is_numeric($_GET['key'])){
			$pages = d('config')->get('pages');
			$key = $_GET['key'];
			unset($pages[$key]);
			d('config')->set('pages',$pages);
			header("Location:./?m=page&a=Index");
		}
	}
	
	function actionAdvanced(){
		if(!isset($_GET['key']) || !is_numeric($_GET['key'])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setAdvanced();
		}
		$key = $_GET['key'];
		$pages = d('config')->get('pages');
		if(!isset($pages[$key])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		$page = $pages[$key];
		include tpl('pageAdvanced');
	}
	
	function actionReplace(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setReplace();
		}
		if(!isset($_GET['key']) || !is_numeric($_GET['key'])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		$key = $_GET['key'];
		$pages = d('config')->get('pages');
		if(!isset($pages[$key])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		$page = $pages[$key];
		include tpl('pageReplace');
	}
	
	function actionEditReplace(){
		if(!isset($_GET['key']) || !is_numeric($_GET['key'])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		
		$pages = d('config')->get('pages');
		$key = $_GET['key'];
		if(!isset($pages[$key])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		$page = $pages[$key];
		$item = array();
		if(!isset($_GET['rekey']) || !isset($page['replaces']) || !isset($page['replaces'][$_GET['rekey']])){
			header("Location:./?m=page&a=replace&key=$key");
			exit;
		}
		$item = $page['replaces'][$_GET['rekey']];
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setReplace();
			header("Location:./?m=page&a=replace&key=$key");
		}
		include tpl('editPageReplace');
	}
	
	function actionDelReplace(){
		if(!isset($_GET['key']) || !is_numeric($_GET['key'])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		if(!isset($_GET['rekey']) || !is_numeric($_GET['rekey'])){
			header("Location:./?m=page&a=replace&key=$_GET[key]");
			exit;
		}
		
		$pages = d('config')->get('pages');
		$key = $_GET['key'];
		if(!isset($pages[$key]) || !isset($pages[$key]['replaces']) || !isset($pages[$key]['replaces'][$_GET['rekey']])){
			header("Location:./?m=page&a=replace&key=$key");
			exit;
		}
		$page = $pages[$key];
		unset($page['replaces'][$_GET['rekey']]);
		$pages[$key]=$page;
		d('config')->set('pages',$pages);

		header("Location:./?m=page&a=replace&key=$key");
	}
	
	function setAdvanced(){
		if(!isset($_GET['key']) || !is_numeric($_GET['key'])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		
		$pages = d('config')->get('pages');
		$key = $_GET['key'];
		if(!isset($pages[$key])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		$page = $pages[$key];
		
		$page['cookies']=$_POST['cookies'];
		
		$page['agent']=$_POST['agent'];
		$page['diyAgent']=$_POST['diyAgent'];
		
		$page['referer']=$_POST['referer'];
		$page['diyReferer']=$_POST['diyReferer'];
		
		$page['ip']=$_POST['ip'];
		$page['diyIp']=$_POST['diyIp'];
		
		$pages[$key] =$page;
		$pages = d('config')->set('pages',$pages);
	}
	
	function setPage(){
		$item['name'] = $_POST['name'];
		$item['uri'] = $_POST['uri'];
		$item['host'] = $_POST['host'];
		$item['replaceDomain'] = $_POST['replaceDomain'];
		$item['returnType'] = $_POST['returnType'];
		$item['relativeHTML'] = $_POST['relativeHTML'];
		$item['relativeCSS'] = $_POST['relativeCSS'];
		$item['template'] = $_POST['template'];
		
		$pages = d('config')->get('pages');

		if(is_numeric($_POST['key'])){
			$pages[$_POST['key']] = $item;
		}else{
			$pages[] = $item;
		}
		d('config')->set('pages',$pages);
	}

	function setReplace(){
		if(!isset($_GET['key']) || !is_numeric($_GET['key'])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		
		$item['name'] = $_POST['name'];
		$item['seach'] = $_POST['seach'];
		$item['replace'] = $_POST['replace'];
		
		$pages = d('config')->get('pages');
		$key = $_GET['key'];
		if(!isset($pages[$key])){
			header("Location:./?m=page&a=Index");
			exit;
		}
		$replaces = isset($pages[$key]['replaces']) ? $pages[$key]['replaces'] : array();

		if(is_numeric($_POST['rekey'])){
			$replaces[$_POST['rekey']] = $item;
		}else{
			$replaces[] = $item;
		}
		$pages[$_GET['key']]['replaces'] = $replaces;
		d('config')->set('pages',$pages);
	}
}