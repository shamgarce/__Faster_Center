<?php
/**
 * Description of index
 * @author Administrator
 */
class welcome extends MpController {

    public function doIndex() {
//        $data=array(
//            'title'=>'测试登陆',
//            're' => '/u',           //登陆之后的地址
//        );
//        $this->view("welcome",$data);
        \Sham::R("/u/home.index");
    }
}
