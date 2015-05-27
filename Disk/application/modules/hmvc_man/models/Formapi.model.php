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
		//根据id监测是否有重复的api
		if(empty($this->args['id'])) {
			//监测该api是否有重复的
			if(\Seter\Seter::getInstance()->table->f_userapi->where("api='{$this->args['api']}'")->getcount()>0){
				$this->json(-200,'该api已经存在');
				return false;
			};
		}


		if(!empty($this->args['api']) && !empty($this->args['name'])){
			$this->json(200,'add successed');
			return true;
		}else{
			$this->json(-200,'api and name must not empty');
			return false;
		}
	}

	public function edit()
	{
		if($this->addValidator()){
			\Seter\Seter::getInstance()->table->f_userapi->where("id='{$this->args['id']}'")->update($this->args);
			$this->json(200,'add successed');
			return true;
		}else{
			return false;
		}
	}

	//添加一条新记录
	public function addnew()
	{
		//print_r($this->args);
		if($this->addValidator()){
			\Seter\Seter::getInstance()->table->f_userapi->insert($this->args);
			$this->json(200,'add successed');
			return true;
		}else{
			return false;
		}
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


