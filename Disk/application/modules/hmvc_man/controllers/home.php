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
                'apiget'    => $this->Seter->table->f_userapi->where(" TYPE = 'GET'")->order("sort desc")->getall(),
                'apipost'   => $this->Seter->table->f_userapi->where(" TYPE = 'POST'")->order("sort desc")->getall(),
                'apiput'    => $this->Seter->table->f_userapi->where(" TYPE = 'PUT'")->order("sort desc")->getall(),
                'apidelete' => $this->Seter->table->f_userapi->where(" TYPE = 'DELETE'")->order("sort desc")->getall(),
                'apiother'  => $this->Seter->table->f_userapi->where(" TYPE = 'OTHER'")->order("sort desc")->getall(),
                'title'=>'列表'
            );
            //print_r($data['apiget']);
            $this->view("home/index",$data);
        }


    }

    //查看模拟
    public function doView($id = '') {
        $data=array(
            'row' => $this->Seter->table->f_userapi->where(" id = '$id'")->getrow(),
            'title'=>'查看接口'
        );
        $this->view("home/dialog/apiview",$data);
    }

    //查看
    public function doViewlog($id = '') {
       $row = $this->Seter->table->f_userapi->where(" id = '$id'")->getrow();
        $ar_ = \Sham::getarr($row['api'],0,'.');
        $ar['router.module'] = $row['v'];
        $ar['router.c'] = $ar_[0];
        $ar['router.m'] =$ar_[1];

        $data=array(
            'loglist' =>$this->Seter->mdb->find("dy_log",$ar,array("sort"=>array("time.timecu"=>-1),"limit"=>5)),
            'title'=>'查看接口'
        );

        $this->view("home/dialog/apilogview",$data);
    }



    //添加
    public function doapiadd() {
        if(ISPOST){
            $this->model->formapi->load($this->Seter->request->post) && $this->model->formapi->addnew();
            $this->gojson();
        }else {
            $data=array(
                'title'=>'添加api'
            );
            $this->view("home/dialog/apiadd",$data);
        }
    }

    //编辑
    public function doApiedit($id = '') {
        if(ISPOST){

            $this->model->formapi->load($this->Seter->request->post) && $this->model->formapi->edit();
            $this->gojson();
        }else{
            $data=array(
                'row' => $this->Seter->table->f_userapi->where(" id = '$id'")->getrow(),
                'title'=>'修改接口'
            );
            $this->view("home/dialog/apiedit",$data);
        }
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

