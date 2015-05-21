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
        //$instance = MpController::getInstance();
        //var_dump($instance->Seter);
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
    public function doUserlist($flit = '',$a='') {
//        echo $flit;
//        echo $a;
$ms = $this->Seter->table->dy_user;


      var_dump($ms->test());
        exit;
        $data=array(
            'userlist' => $this->model->user->getuserlist($flit),
            'title'=>'用户列表'
        );
        $this->view("home/userlist",$data);
    }

    /*
     * 添加用户
     * */
    public function doUseradd() {

        if(ISPOST){
            $this->model->formuser->load() && $this->model->formuser->add();
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
            $this->model->formuser->load() && $this->model->formuser->update();
            $this->gojson();
        }else{
            $data=array(
                'user' => $this->model->user->getuserbyid($uid),
                'title'=>'修改用户'
            );
            $this->view("home/dialog/useredit",$data);
        }
    }

    public function doDialog()
    {

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
			'jsoncode'	=> $this->jsoncode,
			'jsonmsg'	=> $this->jsonmsg,
			'jsondata'	=> $this->jsondata
		);
		echo json_encode($res);
		exit;
	}

}

