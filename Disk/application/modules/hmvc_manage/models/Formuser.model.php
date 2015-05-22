<?php
class Formuser extends MpModel {
    public function __construct() {
        parent::__construct();
    }

    /*
     * 获取post过来的信息
     * */

    public function cflag()
    {
        return $this->Validator();
    }

    public function load()
    {
        return $this->Validator();
    }

    //添加信息
    public function add()
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


