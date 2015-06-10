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

        


        $data = array();
        $this->view("login",$data);
    }

    //======================================================
    //输出json
	public function go(){
        $this->Seter->getjsoninfo();
	}


}

