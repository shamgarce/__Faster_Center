<?php

/**
 * Description of index
 *
 * @author Administrator
 */
class Home extends MpController {

    /*
     * 首页
     * */
    public function doIndex($name = '') {


        $this->view("welcome", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }






    /*
     * 测试内容
     * */
    public function doTest($name = '') {
        $this->view("welcome", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }


}

