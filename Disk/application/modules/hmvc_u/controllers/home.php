<?php
use \Seter\Sham;

/**
 */
class Home extends MpController {
    function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
        if($this->router['mpath'] !='home.login') {        //文档系统
            if ($this->Seter->vuser->isguest) {
                \Sham::R('/u/home.login');
            }
        }
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




    public function doLogin() {

        if(ISPOST){
            $this->model->login->load($this->Seter->request->post)->login();
        }



        $data = array(
            'title'=>'仪表盘',
            're' => '/u/home.index',           //登陆之后的地址
        );
        $this->view("home/login",$data);

//        $data=array(
//            'title'=>'测试登陆',
//            're' => '/u',           //登陆之后的地址
//        );
//        $this->view("welcome",$data);


    }

    //登出
    public function doLogout() {
        $this->Seter->vuser->logout();
        \Sham::R('/');
    }






}

