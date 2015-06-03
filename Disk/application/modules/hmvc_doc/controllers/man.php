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
class Man extends MpController {
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
        $this->view("man/index",$data);
    }


    //添加
    public function doBookedit($book = '',$node = '',$ver='')
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
        $this->view("man/bookedit",$data);
    }

    //book管理
    public function doBook() {
        /*
         * 管理
         * */
        $list_ = $this->Seter->doc->getindexlist();
        //加上每个下面的文章
        if(!empty($list_)){
            foreach($list_ as $key=>$value){

                //$list[$value] = $this->Seter->doc->wzlist($value);
                $li_ = $this->Seter->doc->wzlist($value);
                $list[$value] = $li_[$value];

            }
        }

        print_r($list);

        $data['list'] = $list;
        $this->view("man/book",$data);
    }

    public function doSet() {
        echo 'doset';
    }
}
