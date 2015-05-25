<?php

/**
 * Description of index
 *
 * @author Administrator
 */
class Home extends MpController {
    function __construct()
    {
        parent::__construct();
        $this->Seter = new \Seter\Seter();
//        //$instance = MpController::getInstance();
//        //var_dump($instance->Seter);
//        \Sham::trace(__METHOD__);             //执行路径记录
//        print_r(\Sham::gettrace());           //显示
    }
    /*
     * 首页
     * */
    public function doIndex($name = '') {
        $data=array(
            'title'=>'仪表盘'
        );
        $this->view("home/index",$data);
    }

    /*
     * 测试内容
     * */
    public function doUserlist($flit = '0') {
        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post) && $this->model->formuser->cflag();
            $this->gojson();
        }
        $data=array(
            'userlist' => $this->model->user->getuserlist($flit),
            'title'=>'用户列表'
        );



        $this->view("home/userlist",$data);
        echo 1;
    }

    /*
     * 添加用户
     * */
    public function doUseradd() {

        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post) && $this->model->formuser->add();
            $this->gojson();
        }
        $data=array(
            'title'=>'添加用户'
        );
        $this->view("home/dialog/useradd",$data);
    }

    /*
     * 修改用户
     * */
    public function doUseredit($uid = 0)
    {
        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post) && $this->model->formuser->update();
//            $this->model->formuser->load() && $this->model->formuser->update();
            $this->gojson();
        }else{
            $data=array(
                'user' => \Seter\Seter::getInstance()->table->f_user->where("uid = $uid")->getrow(),
                'title'=>'修改用户'
            );
            $this->view("home/dialog/useredit",$data);
        }
    }

    public function doDialog()
    {
        $this->model->user->test();
        $dialog = array();
        $dialog[] = array(
            'title' => '添加用户',
            'uri'   => '/manage/home.useradd',
        );
        $dialog[] = array(
            'title' => '编辑用户',
            'uri'   => '/manage/home.useredit',
        );


        $data['dialog'] = $dialog;
        $this->view("home/dialog",$data);
    }



    //输出json
    public $isjson = false;
    public $jsoncode = 0;
    public $jsonmsg = '';
    public $jsondata = array();
	public function gojson(){
		$res = array(
			'code'	=> $this->jsoncode,
			'msg'	=> $this->jsonmsg,
			'data'	=> $this->jsondata
		);
		if($this->isjson){
            echo json_encode($res);
            exit;
        }
	}

}

