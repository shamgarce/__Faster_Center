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
        if(!$this->Seter->user->islogin()){
            if($this->router['mpath'] !='man.bookedit'){
                \Sham::R('/manage/home.login/?re='.\Sham::shtmlspecialchars($_SERVER['REQUEST_URI']));
            }
        }
    }


//    public function doTest()
//    {
////$list = $this->Seter->doc->getbooklist();                 //获取booklist
////$list = $this->Seter->doc->book('s2')->getnodelist();     //根据book获取node list
////$list = $this->Seter->doc->book('s2')->node('3')->getver();             //获取版本号
//$list = $this->Seter->doc->book('s2')->node('3')->ver(1)->getnode();        //获取某个节点的内容
//
//
//$nr = '';
//$ar = array(
//    'nr'=>$nr,
//    'lc'=>$nr,
//    'sx'=>$nr,
//);
//$list = $this->Seter->doc->book('s2')->node('3')->put($ar);
//
//    }

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

//$nr = '';
$ar = array(
    'nr'=>$post['nr'],
    'lc'=>$post['sx'],
    'sx'=>$post['lc'],
);
$this->Seter->doc->book($post['book'])->node($post['node'])->put($ar);

//            $this->Seter->doc->save($post['book'],$post['node'],$post['nr']);
//            $this->Seter->doc->set('Flo')->save($post['book'],$post['node'],$post['sx']);
//            $this->Seter->doc->set('Seq')->save($post['book'],$post['node'],$post['lc']);

            $url ="/doc/home.view/{$post['book']}/{$post['node']}";
            $url2 = '/doc/man.book';
            \Sham::R($url);
        }

        $bnr = array();
        if (!empty($book) && !empty($node)) {
            $bnr = $this->Seter->doc->book($book)->node($node)->ver($ver)->getnode();
            //$bnr = $this->Seter->doc->getnr($book, $node, $ver);   //内容
        }
       // print_r($bnr);
        $data = array(
            'book' => $book,
            'node' => $node,
            'ver' => $ver,
            'nr' => $bnr['nr'],
            'sx' => $bnr['sx'],
            'lc' => $bnr['lc'],

        );
        $this->view("man/bookedit",$data);
    }

    public function doRefreshbook($book = '',$node='')
    {
        $this->Seter->doc->book($book)->node($node)->refresh();
        \Sham::R('/doc/man.book');
    }

    public function doBookdelete($book = '')
    {
//        $this->Seter->doc->deletebook($book);
        \Sham::R('/doc/man.book');
    }

    //book管理
    public function doBook() {
        /*
         * 管理
         * */
//        $list_ = $this->Seter->doc->getindexlist();
        $list_ = $this->Seter->doc->getbooklist();
        //加上每个下面的文章
        if(!empty($list_)){
            foreach($list_ as $key=>$value){
                $li_ = $this->Seter->doc->book($value)->getnodelist();
                //$li_ = $this->Seter->doc->wzlist($value);
                foreach($li_ as $key2=>$value2){
                    rsort($value2);
                    $list[$value][$key2] =$value2;
                }
            }
        }
//print_r($list_);
//        exit;
        $data['list'] = $list;
        $data['debug'] =true;
        $this->view("man/book",$data);
    }

    public function doSet() {
        echo 'doset';
    }
}

