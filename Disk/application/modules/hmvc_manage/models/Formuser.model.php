<?php
/*
 * 模块内返回两种数据形式
 * 1：true false
 * 2：json直接输出
 * 3：其他数据类型
 * */

class Formuser extends MpModel
{

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



    public function addValidator()
    {
        //验证用户名 密码
        if(empty($this->args['uname']) || empty($this->args['pwd'])){
            $this->json(-200,'uname upwd must input')->gojson();
            return false;
        }
        if($this->S->table->f_user->where("uname='{$this->args['uname']}'")->getcount() > 0){
            $this->json(-200,'uname exist')->gojson();
            return false;
        }
        return true;
    }

    //添加信息
    //根据用户名密码 添加用户
    public function add()
    {
        if($this->addValidator()){
            $this->args['groupid'] = 9;
            $this->args['creattime'] = time();
            $this->args['authKey'] = md5(time().$this->args['uname']);
            $this->args['pwd'] = \Seter\Seter::hash($this->args['pwd']);
            $this->S->table->f_user->insert($this->args);
            $this->json(200,'操作成功')->gojson();
        }else{
            $this->json(-200,'操作不成功')->gojson();
        }
    }

    ///manage/home.userlist
    public function cflag()
    {
        $this->args['enable'] = !empty($this->args['enable'])?0:1;
        $this->S->table->f_user->where("uname='{$this->args['uname']}'")->update($this->args);
        $this->json(200,'active successed')->gojson();
    }



    public function updateValidator()
    {
        //验证用户名 密码
        if(empty($this->args['pwd'])){
             unset($this->args['pwd']);
        }else{
            if(strlen($this->args['pwd'])<6){
                $this->json(-200,'pwd is too short')->gojson();
                return false;
            }else{
                $this->args['pwd'] = md5($this->args['pwd']);
            }
        }
        return true;
    }












    /*更改用户
     * */
    public function update()
    {
        if($this->updateValidator()){
            $this->S->table->f_user->where("uname='{$this->args['uname']}'")->update($this->args);
            $this->json(200,'操作成功')->gojson();
        }else{
            $this->json(-200,'操作不成功')->gojson();
        }
    }


    /*
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
            $this->res['code'] = -200;
            $this->res['msg'] = "$key is empty";
            return false;
        }
        return true;
    }

//    public function json($code=0,$msg='')
//    {
//        \Home::getInstance()->isjson = true;
//        \Home::getInstance()->jsoncode = $code;
//        \Home::getInstance()->jsonmsg = $msg;
//    }

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


