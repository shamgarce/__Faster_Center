<?php
class Logintest extends MpModel
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
        if($this->Isnotempty('uname') && $this->Isnotempty('pwd')){
            //do
            $this->args['uname'] = \Sham::saddslashes($this->args['uname']);
            $row = $this->S->table->f_user->where("uname = '{$this->args['uname']}'")->getrow();
            if(empty($row)){
                $this->json(-200,'用户不存在')->gojson();
            }else{
                if($row['pwd'] == $this->S->hash($this->args['pwd'])){
                    //禁用的用户
                    if($row['enable']!=1){
                        $this->json(-200,'无效用户')->gojson();
                    }
                    //更改登陆信息
                    $ar = array(
                        'logip'=>\Sham::GetIP(),
                        'logtime'=>\Sham::T(),
                    );
                    //更改数据库激励
                    $this->S->table->f_user->where("uname = '{$this->args['uname']}'")->update($ar);
                    //日志记录


                    //dolog
                    //算法验证保证COOKIE安全
                    $tm = time();
                    $signnature = \Sham::signnature($row['uname'].$row['tname'].$row['authkey'].$tm);;
                    \Sham::setcookie('uname',$row['uname']);
                    \Sham::setcookie('tname',$row['tname']);
                    \Sham::setcookie('authkey',$row['authkey']);
                    \Sham::setcookie('tm',$tm);
                    \Sham::setcookie('signature',$signnature);             //签名算法

                    $this->json(200,'登陆成功')->gojson();
                }else{
                    $this->json(-200,'密码错')->gojson();
                }
            }
        }else{
            $this->json(-200,'用户名密码不能为空')->gojson();
        }
        return $this;
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
            $this->res['code'] = -200;
            $this->res['msg'] = "$key is empty";
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


