<?php
use \Seter\Sham;

/**
 * 用户后台，所有用户都可以访问
 */
class Home extends MpController {
    function __construct()
    {
        parent::__construct();

        //登陆之后才可以访问
        $this->Seter = \Seter\Seter::getInstance();
        if (!$this->Seter->user->islogin()) \Sham::R('/login');
    }

    /*
     * 首页
     * */
    public function doIndex($name = '') {
        $data=array(
            'title'=>'仪表盘'
        );
        $this->view("home/index",$data);
    }

}

