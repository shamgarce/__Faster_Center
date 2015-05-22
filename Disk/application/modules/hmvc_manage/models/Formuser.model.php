<?php
class Formuser extends MpModel
{

    public $args = array();

    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 获取post过来的信息
     * */
    public function load($arg)
    {
        $this->args = $arg;
        return true;
    }


    public function addValidator()
    {
        //验证用户名 密码
        if(empty($this->args['uname']) || empty($this->args['pwd'])){
            $this->json(-200,'uname upwd must input');
            return false;
        }
        if(\Seter\Seter::getInstance()->table->f_user->where("uname='{$this->args['uname']}'")->getcount() > 0){
            $this->json(-200,'uname exist');
            return false;
        }
        return true;
    }
    //添加信息
    //根据用户名密码 添加用户
    public function add()
    {
        if($this->addValidator()){
            \Seter\Seter::getInstance()->table->f_user->insert($this->args);
            return true;
        }else{
            return false;
        }
    }

    ///manage/home.userlist
    public function cflag()
    {
        $this->args['enable'] = !empty($this->args['enable'])?0:1;
        \Seter\Seter::getInstance()->table->f_user->where("uname='{$this->args['uname']}'")->update($this->args);
        $this->json(200,'active successed');
        return true;
    }



    public function updateValidator()
    {
        //验证用户名 密码
        if(empty($this->args['pwd'])){
             unset($this->args['pwd']);
        }else{
            if(strlen($this->args['pwd'])<6){
                $this->json(-200,'pwd is too short');
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
            \Seter\Seter::getInstance()->table->f_user->where("uname='{$this->args['uname']}'")->update($this->args);
            return true;
        }else{
            return false;
        }
    }

    public function json($code=0,$msg='')
    {
        \Home::getInstance()->isjson = true;
        \Home::getInstance()->jsoncode = $code;
        \Home::getInstance()->jsonmsg = $msg;
    }


}


