<?php
class Formapi extends MpModel
{

	public $args = array();

	public function __construct()
	{
		parent::__construct();
	}


	public function debugcheck()
	{
		if($this->isdebug()){
			//debug模式，返回debug结果
			return false;
		}else{
			return true;
		}
	}

	public function isdebug()
	{
		return true;
	}

	public function json($code=0,$msg='')
	{
		\Home::getInstance()->isjson = true;
		\Home::getInstance()->jsoncode = $code;
		\Home::getInstance()->jsonmsg = $msg;
	}


}


