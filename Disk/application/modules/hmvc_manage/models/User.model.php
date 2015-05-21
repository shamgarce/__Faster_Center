<?php
class User extends MpModel {
    public function __construct() {
        parent::__construct();
    }

    //添加信息
    public function getuserlist()
    {
        return true;
    }

    public function update()
    {
        return true;
    }

    //验证信息
    public function Validator()
    {
        return true;
    }

}


