<?php
class V6friend extends MpModel
{
	public $args = array();
	public $res = array();

	public function __construct()
	{
		parent::__construct();
	}

	public function load($arg)
	{
		$this->args = $arg;
		return true;
	}

	public function Validators()
	{
		return true;
	}

	public function search()
	{
		if($this->Isnotempty('username')){
			//do
			echo 'do2';
			//查找好友
		}
		$this->jsonout();
	}

	public function add()
	{
		if($this->Isnotempty('targetid')){
			//do
			echo 'do3';
			//添加好友
		}
		$this->jsonout();
	}


	//
	public function getfriends()
	{
		if($this->Isnotempty('userid')){
			//do
			echo 'do4';
			//添加好友
		}
		$this->jsonout();
	}












	public function Isnotempty($key)
	{
		if(empty($this->args[$key])){
			$this->res['code'] = -200;
			$this->res['msg'] = "$key is empty";
			return false;
		}
		return true;
	}

	public function jsonout($code=0,$msg = '')
	{
		if($code)	$this->res['code']= $code;
		if($msg)	$this->res['msg']= $code;
		echo json_encode($this->res);
		exit;
	}

}


