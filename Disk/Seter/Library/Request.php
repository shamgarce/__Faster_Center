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

    public function get(){
        $mp = \WoniuRouter::parseURI();
        $query = $mp['query'];
        //urldecode 解码所有的参数名，解决get表单会编码参数名称的问题
        $pq = $_pq = array();
        $_pq = explode('&', $query);
        foreach ($_pq as $value) {
            $p = explode('=', $value);
            $pq[$p[0]] = $p[1];
//            if (isset($p[0])) {
//                $p[0] = urldecode($p[0]);
//            }
//            $pq[] = implode('=', $p);
        }
        //return $pathinfo_query;
//        friend.search&s==1&mtsrt
        //计算get
        return $pq;
    }

    public function cookie(){
        return $_COOKIE;
    }
    public function __get($name){
        return $this->$name();
    }


    //=======================================
    //=======================================



}

