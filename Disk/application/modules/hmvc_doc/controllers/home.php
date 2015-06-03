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
//            \Sham::R('/manage/home.login/?re='.\Sham::shtmlspecialchars($_SERVER['REQUEST_URI']));
//        }
    }


    public function doIndex() {
        /*
         * 不带管理功能的
         * */
        $this->view("home/index",$data);
    }







    public function doDisplay() {
//echo 123;
//        //$this->input->setCookie()和$this->input->cookie()
//        print_r($_COOKIE);
//        setCookie('use1','te',time()+5,'/');
//        echo         $this->input->cookie('use1');
////        echo cookie('use1');
//        //setCookie($key, $value, $life = null, $path = '/', $domian = null, $http_only = false)
////        setCookie('test1','testdoc',time()+5,'/');
////echo         $this->input->cookie('test1');
////        exit;
////        print_r($_COOKIE);
//        $this->Seter->user->display();
//
////        echo $this->Seter->user->islogin();
////        echo $this->Seter->user->isguest();
//        exit;
//        var_dump($this->input);
//        print_r($this->input->cookie());
//        print_r($_COOKIE);
//        $this->Seter->user->display();
    }

}

