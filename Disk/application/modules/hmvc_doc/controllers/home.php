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



    public function doMan() {
        /*
         * 管理
         * */
        $this->view("home/man",$data);
    }

    //添加
    public function doManbookedit($book = '',$node = '',$ver='')
    {
        if(ISPOST){
            //添加记录
            $post = $this->Seter->request->post;
            if(empty($post['book']) || empty($post['node']) || empty($post['nr'])){
                echo 'empty<a href="#" onclick="javascript:history.back(-1);">back</a>';
                exit;
            }
            $this->Seter->doc->save($post['book'],$post['node'],$post['nr']);
            \Sham::R('/doc/home.manbook');
        }

        $bnr = array();
        if (!empty($book) && !empty($node)) {
            $bnr = $this->Seter->doc->getnr($book, $node, $ver);   //内容
        }
        $data = array(
            'book' => $book,
            'node' => $node,
            'ver' => $ver,
            'nr' => $bnr['nr'],
        );
        $this->view("home/manbookedit",$data);
    }

    //book管理
    public function doManbook() {
        /*
         * 管理
         * */
        $list_ = $this->Seter->doc->getindexlist();
        //加上每个下面的文章
        if(!empty($list)){
            foreach($list_ as $key=>$value){
                $list[$value] = $this->Seter->doc->wzlist($valuie);
            }
        }

        $data['list'] = $list;
        $this->view("home/manbook",$data);
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

