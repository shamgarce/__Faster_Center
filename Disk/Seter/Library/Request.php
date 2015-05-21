<?php

namespace Seter\Library;

class Request{

    public $mysql_disable_cache_tables = array();// 不允许被缓存的表，遇到将不会进行缓存
    public $base            = '';

    private $props = array();                   //单例结构
    public static $instance;

    public function __construct($chr = 'default'){

    }

    public function post(){
        return $_POST;
    }


    //=======================================
    //=======================================



}

