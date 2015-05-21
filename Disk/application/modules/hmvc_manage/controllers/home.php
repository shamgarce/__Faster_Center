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

        $data=array('title'=>'仪表盘');
        $this->view("home/index",$data);
    }

    /*
     * 测试内容
     * */
    public function doUserlist($name = '') {
        $data=array('title'=>'用户列表');
        $this->view("home/userlist",$data);
    }

    /*
     * 添加用户
     * */
    public function doUseradd($uid = '') {
        $data=array('title'=>'添加用户');
        $this->view("home/sp/userlist",$data);
    }

    /*
     * 修改用户
     * */
    public function doUseredit($uid = '')
    {

        $data=array('title'=>'添加用户');
         $this->view("home/sp/userlist",$data);
    }






}

