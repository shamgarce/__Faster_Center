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
    //添加信息
    public function getuserlist($def = '')
    {
        switch($def){
            case '9999':
                return $this->Seter->table->f_user->where('enable = 0')->order('uid desc')->getall();
                break;
            case 1:
                return $this->Seter->table->f_user->where('enable = 1')->order('uid desc')->getall();
                break;
            default:    //0 全部
                return $this->Seter->table->f_user->order('uid desc')->getall();
                break;
        }

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


