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

        $md = $this->accessRules();
print_r($md);
        echo 1;
//        print_r($this->router);
        exit;
        \Sham::R("/u/home.index");
    }







}
