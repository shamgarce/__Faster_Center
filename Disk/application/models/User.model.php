<?php
/*用户模型，在哪都能调用
先尝试写到Seter中
 * */
class User extends MpModel
{

    public function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
    }

    /*
     * 获取post过来的信息
     * */
    public function load($arg)
    {
        $this->args = $arg;
        return true;
    }

    public function test()
    {
    }


    public function json($code=0,$msg='')
    {
        \Home::getInstance()->isjson = true;
        \Home::getInstance()->jsoncode = $code;
        \Home::getInstance()->jsonmsg = $msg;
    }


}


