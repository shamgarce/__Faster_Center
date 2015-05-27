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
        $this->model->log->L(700,'IO');
        //========================================
        //===
        $this->routerstr = $this->router['mpath'];
//        $this->routerstr = 'docnav/hospitalguidelist';
        $this->row = $this->Seter->table->f_userapi->where("api='$this->routerstr'")->getrow();
        if($this->row['debug'] == 0 ){            //调试模式
            echo $this->row['response'];
            if(empty($this->row['response'])){
                $res = array(
                    'code' => '-9',
                    'msg' => 'no response',

                );
                echo json_encode($res);

            }

            exit;
        }
    }


    public function doIndex() {

        $res=array(
            'title'=>'v6 index'
        );
        echo json_encode($res);
    }

//    function dotest() {
////        echo '12123123123123';
//////        print("Did you call me? I'm $name!");
//    }




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

