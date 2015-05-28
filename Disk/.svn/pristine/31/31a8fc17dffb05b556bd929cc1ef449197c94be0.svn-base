<?php

/**
 * Description of index
 *
 * @author Administrator
 */
class Login extends MpController {


    /*
     * 系统登陆地址 http://192.168.1.200:81/manage/login.index
     * 首页
     * */
    public function doIndex($name = '') {
        $this->view("login/index", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }

    public function doLogout($name = '') {
        echo '登出';
//        $this->view("login/index", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }

    /*
     * 创建的动作
    */
    public function __construct() {
        parent::__construct();
    }

    /*
     * 测试内容
     * */
    public function doTest($name = '') {
        $this->view("welcome", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }


}

