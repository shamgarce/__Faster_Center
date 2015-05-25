<?php
class Formapi extends MpModel
{

	public $args = array();

	public function __construct()
	{
		parent::__construct();
	}

	/*
     * 获取post过来的信息
     * */
	public function load($arg)
	{
		$this->args = $arg;
		return true;
	}


	public function addValidator()
	{

		return true;
	}

	///manage/home.userlist
	public function cflag()
	{

		isset($this->args['enable']) && $this->args['enable'] = !empty($this->args['enable'])?0:1;
		isset($this->args['debug']) && $this->args['debug'] = !empty($this->args['debug'])?0:1;
		\Seter\Seter::getInstance()->table->f_userapi->where("id='{$this->args['id']}'")->update($this->args);
		$this->json(200,'active successed');
		return true;
	}

	public function test()
	{
		echo 123;
	}

	public function json($code=0,$msg='')
	{
		\Home::getInstance()->isjson = true;
		\Home::getInstance()->jsoncode = $code;
		\Home::getInstance()->jsonmsg = $msg;
	}


}


