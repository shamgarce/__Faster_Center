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
			//根据username 获取关系
			//检索该用户是否存在
			$u = \Seter\Seter::getInstance()->table->v3_user->where("user_login = '{$this->args['username']}'")->getrow();
			if(empty($u)){
				$this->jsonout(-200,'没有发现用户');
			}else{
				$this->res['data'] = array(
										"userid"=>$u['user_login'],
										"username"=> $u['user_login'],
										"portrait"=> $u['user_login']
									);
				$this->jsonout(200,'该用户存在');
			}
		}
		$this->jsonout();
	}

	//uid 是我自己的username
	public function add()
	{
		if($this->Isnotempty('username') && $this->Isnotempty('targetname')){

			$ar = array(
				'uname1'=>$this->args['username'],
				'uname2'=>$this->args['targetname'],
			);
			\Seter\Seter::getInstance()->table->f_relation->insert($ar);

			$this->res['code'] = 200;
			$this->res['msg'] = "添加好友成功";
		}
		$this->jsonout();
	}

	//uid 是我自己的username
	public function getToken()
	{
		if($this->Isnotempty('username')){
			$token = \Seter\Seter::getInstance()->ry->getToken($this->args['username'],$this->args['username'],$this->args['username']);
			die($token);
			$this->res['data'] = $token;
			$this->jsonout(200,'cheonggong');
		}
		$this->jsonout();
	}

	//
	public function getfriends()
	{
		if($this->Isnotempty('username')){
			$r = \Seter\Seter::getInstance()->table->f_relation->where("uname1='{$this->args['username']}' or uname2='{$this->args['username']}'")->getall();
			foreach($r as $value){
				if($value['uname2']!=$this->args['username']) $r_[$value['uname2']] = 1;
				if($value['uname1']!=$this->args['username']) $r_[$value['uname1']] = 1;
			}
			if(!empty($r_)){
				foreach($r_ as $key=>$value){
					$dt = array(
						"userid"=>$key,
						"username"=> $key,
						"portrait"=> $key,
					);
					$dt_[] = $dt;
				}
			}
			$this->res['code'] = 200;
			$this->res['msg'] = 'ok';
			$this->res['data'] = $dt_;
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
		if($msg)	$this->res['msg']= $msg;
		echo json_encode($this->res);
		exit;
	}

}


