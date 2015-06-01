<?php

use \Seter\Sham;

/**
 * Description of index
 *
 * @author Administrator
 *
 * 几点需要考虑的
 * 1 ：调试返回数据 【模拟】
 * 2 ：关闭返回数据
 * 3 ：初始没有代码返回数据
 */
class Home extends MpController {
    function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
        //文档系统

//        //判断是否登陆
//        if($this->Seter->user->isguest){
//            \Sham::R('/manage/home.logintest/?re='.\Sham::shtmlspecialchars($_SERVER['REQUEST_URI']));
//        }
    }


    public function doIndex() {
        echo 123;
    }

    public function doDis() {
        echo 'dis';
    }

    public function doDisplay() {
        setcookie('sdf',123);
        print_r($_COOKIE);
        $this->Seter->user->display();

//        echo $this->Seter->user->islogin();
//        echo $this->Seter->user->isguest();
        exit;
        var_dump($this->input);
        print_r($this->input->cookie());
        print_r($_COOKIE);
        $this->Seter->user->display();
    }

}

