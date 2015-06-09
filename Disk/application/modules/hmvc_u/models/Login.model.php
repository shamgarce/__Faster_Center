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

    /*
     * 是否json输出
     * */
    public $isjson = false;

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
        if($this->S->vuser->login($this->args['uname'],$this->args['pwd'])){
            $this->res['url'] = $get['re'];
            $this->json(200,'登陆成功')->gojson();
        }else{
            $this->S->jsonout();
        }
    }

    /*
     * ======================================================
     * ======================================================
     * ======================================================
     * ======================================================
     * 获取post过来的信息
     * 用户链式操作
     * */
    public function load($arg)
    {
        $this->args = $arg;
        return $this;
    }

    //是否空
    public function Isnotempty($key)
    {
        if(empty($this->args[$key])){
//            $this->res['code'] = -200;
//            $this->res['msg'] = "$key is empty";
            $this->json(-200,"$key 不能为空");
            return false;
        }
        return true;
    }

    public function json($code=0,$msg='')
    {
        $this->isjson   = true;
        !empty($code)   && $this->res['code'] = $code;
        !empty($msg)    && $this->res['msg']  = $msg;
        return $this;
    }

    public function gojson($isjson=false){
        !empty($isjson)   && $this->isjson = true;
        if($this->isjson){
            echo json_encode($this->res);
            exit;
        }
        return true;
    }

}


