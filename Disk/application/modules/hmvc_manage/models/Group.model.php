<?php
/*用户模型，在哪都能调用
先尝试写到Seter中
 * */
class Group extends MpModel
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
    public function getgrouplist()
    {
        return $this->Seter->table->f_group->order('sort desc')->getall();
    }


}


