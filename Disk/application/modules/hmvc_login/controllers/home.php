<?php

/**
 * 值承担登陆登出任务
 */
class Home extends MpController {
    function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
        $this->model->log->L(700,'登陆');
    }


    public function doIndex() {
        if(ISPOST){
            $this->model->login->load($this->Seter->request->post)->login();

        }
        $data = array();
        $this->view("login",$data);
    }

    public function doReg()
    {
        echo 'reg';
    }


    //dialog
    //通过login/home.dialog 来更改密码
    //更改


    //登出
    public function doLogout() {
        $this->Seter->user->logout();
        \Sham::R('/login');
    }

    public function doR()
    {
        if(!$this->Seter->user->islogin()){
            \Sham::R('/login');
        }
        $this->view("D",$data);
        //\Sham::R('/u');
    }
    //==========================================
    //输出json
	public function go(){
        $this->Seter->getjsoninfo();
	}


}

