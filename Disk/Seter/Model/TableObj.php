<?php

namespace Seter\Model;

class TableObj{
    private $db = null;
    private $result = null;

    public function __construct($tablename=''){
    }

    public function getmaxid()
    {

        $this->result = 123;
        return $this;
    }

    public function getcount()
    {
        $this->result = 123;
        return $this;
    }

    public function getcol()
    {
        $this->result = 123;
        return $this;
    }

    public function getall()
    {
        $this->result = 123;
        return $this;
    }

    public function getrow()
    {
        $this->result = 123;
        return $this;
    }

    public function where()
    {
        $this->result = 123;
        return $this;
    }


    public function test(){
        echo 'tableobj:test:';
        exit;
    }

    public function __get($action) {
        //先判断是否有active
        //如果存在，则执行，并且返回result
        //其他情况，则返回错误信息
    }

}

