<?php

/**
 * Description of index
 *
 * @author Administrator
 */
class Main extends MpController {

    /*
     * //超级管理员管理系统的界面
     * 包括用户管理，。添加删除修改
     * 首页
     * */
    public function doIndex($name = '') {
        $this->view("main/index", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }


    public function doUserlist($flit = '')
    {


        $this->database('default');
        //$query = $this->db->get('doc_metro');
        $query = $this->db->get('doc_metro');
        foreach ($query->result() as $row)
        {
           echo $row->title;
        }


//        echo $query->num_rows();
        var_dump($this->db);
        exit;
print_r($query);

        $this->view("main/userlist");
    }















    /*
     * 设置信息
     * */
    public function doSetinfo()
    {
    }

    /*
     * 更改密码
     * */
    public function doChangepassword($name = '') {
//        $this->view("main/index", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
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
        //$this->view("welcome", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }


}

