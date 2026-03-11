<?php
class data{
	/*
	 * 文件路径
	 * @var string
	 */
	protected $_filePath;
	
	/**
	 * 存储临时数据
	 * @var array
	 */
	protected $_data;
	
	/**
	 * 标记修改的数据
	 * @var bool
	 */
	protected $_write=FALSE;
	
	function __construct($name){
		$this->_filePath = ADIR.'data/'.$name.'.php';
		$this->load();
	}
	
	/**
	 * 读取文件内容, 赋值给_data
	 */
	private function load(){
		if(is_file($this->_filePath)){
			$this->_data=include($this->_filePath);
		}
		if (!is_array($this->_data)) {
			$this->_data = array();
		}
	}
	
	
	/**
	 * 设置键值对数据,有修改则标记_write
	 * @param $field
	 * @param $value
	 */
	function set($key,$value=""){
		if(is_array($key)){
			foreach($key as $key => $value){
				$this->set($key,$value);
			}
			return $this;
		}
		
		if($this->_data[$key]!=$value){
			$this->_data[$key]=$value;
			$this->_write=true;
		}
		return $this;
	}
	
	/**
	 * 获取数据
	 * @param String $field
	 * @return mixed
	 */
	function get($key=""){
		return empty($key)?$this->_data:$this->_data[$key];
	}
	
	/**
	 * 删除数据
	 * @param String $field
	 */
	function del($key=""){
		if(empty($key)){
			$this->_data=NULL;
		}else{
			$this->_data[$key]=NULL;
		}
		$this->_write=true;
	}
	
	/**
	 * 数据保存,写入文件
	 * 
	 * 判断_write是否为真,避免IO操作
	 */
	function __destruct(){
		if(!$this->_write)return;
		if(empty($this->_data)){
			@unlink($this->_filePath);
		}else{
			$filedata='<?php return '.var_export($this->_data,TRUE).';';
			file_put_contents($this->_filePath,$filedata);
		}
	}
	
	/**
	 * 魔术方法__get,获取值
	 * @param String $name
	 */
	public function __get($name){
		return $this->get($name);
	}
	
	/**
	 * 魔术方法__set,设置值
	 * @param $name
	 * @param $value
	 */
	function __set($name,$value){
		return $this->set($name,$value);
	}
}