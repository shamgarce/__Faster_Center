<?php

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
//        //$instance = MpController::getInstance();
//        //var_dump($instance->Seter);
//        \Sham::trace(__METHOD__);             //执行路径记录
//        print_r(\Sham::gettrace());           //显示
    }
    /*
     * 首页
     * 列表显示
     * */
    public function doIndex() {

        if(ISPOST){
            $this->model->formapi->load($this->Seter->request->post) && $this->model->formapi->cflag();
            $this->gojson();
        }else{
            $data=array(
                'apiget'    => $this->Seter->table->f_userapi->where(" TYPE = 'GET'")->order("sort desc")->group('api')->getall(),
                'apipost'   => $this->Seter->table->f_userapi->where(" TYPE = 'POST'")->getall(),
                'apiput'    => $this->Seter->table->f_userapi->where(" TYPE = 'PUT'")->getall(),
                'apidelete' => $this->Seter->table->f_userapi->where(" TYPE = 'DELETE'")->getall(),
                'apiother'  => $this->Seter->table->f_userapi->where(" TYPE = 'OTHER'")->getall(),
                'title'=>'列表'
            );
            //print_r($data['apiget']);
            $this->view("home/index",$data);
        }


    }

    //查看
    public function doView($name = '') {
        echo 'shouye';
//        $data=array(
//            'title'=>'仪表盘'
//        );
//        $this->view("home/index",$data);
    }

    //查看
    public function doViewlog($name = '') {
        echo 'shouye';
//        $data=array(
//            'title'=>'仪表盘'
//        );
//        $this->view("home/index",$data);
    }



    //添加
    public function doapiadd($name = '') {
        echo 'shouye';
//        $data=array(
//            'title'=>'仪表盘'
//        );
//        $this->view("home/index",$data);
    }

    //编辑
    public function doApiedit($name = '') {
        echo 'shouye';
//        $data=array(
//            'title'=>'仪表盘'
//        );
//        $this->view("home/index",$data);
    }




    //======================================================
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

