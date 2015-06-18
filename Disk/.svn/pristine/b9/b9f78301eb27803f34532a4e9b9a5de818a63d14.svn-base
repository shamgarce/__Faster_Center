<?php
/*
 * 数据调取模型
 * 用于调取数据
 *
 * 少量返回数据和操作
 * */
class Sysgroup extends MpModel
{
    public function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
    }

    /**
     * 返回group列表
     */
    public function getgrouplist($enable = 1){
        return $this->Seter->table->f_group->where("enable = $enable")->order(' sort desc')->getall();
    }

    public function groupysid2name(){
        return $this->Seter->table->f_group->colm("groupid,groupname")->getmap();
    }




}


