<?php
class Login extends MpModel
{

    /*
     * /接收到的参数，一般是$post
     * */
    public $args = array();

    /*需要输出的数据 包括 code msg data
     * */
    public $res = array();

    /*Seter 对象
     * */
    public $S = null;

    public function __construct()
    {
        parent::__construct();
        $this->S = \Seter\Seter::getInstance();
    }

    public function login()
    {
        //调用seter登陆模块       //自动记录了cookie
        if($this->S->user->login($this->args['uname'],$this->args['pwd'])){
            $this->res['url'] = $get['re'];
            $this->json(200,'登陆成功')->go();
        }else{
            $this->S->user->go();   //输出json
        }
    }



    /*
     * ======================================================
     * 获取post过来的信息
     * 用户链式操作
     * */
    public function load($arg)
    {
        $this->args = $arg;
        return $this;
    }

    public function json($code=0,$msg='')
    {
        !empty($code)   && $this->res['code'] = $code;
        !empty($msg)    && $this->res['msg']  = $msg;
        return $this;
    }

    public function go(){
        echo json_encode($this->res);
        exit;
    }

}


