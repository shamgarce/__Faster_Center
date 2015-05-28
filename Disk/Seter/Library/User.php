<?php

namespace Seter\Library;
//用户模型
/*
 * 暂时的功能局限到获取自己的信息
 * 调用
 * \Seter\Seter::getInstance()->user->isguest()
 * \Seter\Seter::getInstance()->user->myinfo()
 * \Seter\Seter::getInstance()->user->mygroup()
 * */
class User{
    public function __construct(){
    }


//    public function getusergroup(){
//    }
//    public function getuserlist($page=1,$pagesize=30){
//    }
//    //
//    public function getuserinfo($uid=0){
//    }


//    /*
//     * =============================================================
//     * flit enable/groupid
//     * =============================================================
//     * */
//    public function enable(){
//        return $this;
//    }
//
//    public function group(){
//        return $this;
//    }

    /*
     * =============================================================
     *     //针对当前用户
     * =============================================================
     * */
    public function mygroup()
    {
    }

    public function myinfo()
    {
    }

    public function isguest()
    {
    }

//    public function __set($a, $b) {
//    }
//    public function __get($tablename) {
//    }

    //用户表标准格式
    public function columns()
    {
        /*
         *
mysql> show columns from f_user;
+-------------+-------------+------+-----+---------+----------------+
| Field       | Type        | Null | Key | Default | Extra          |
+-------------+-------------+------+-----+---------+----------------+
| uid         | int(11)     | NO   | PRI | NULL    | auto_increment |
| uname       | varchar(32) | NO   | UNI | NULL    |                |
| tname       | varchar(32) | YES  |     | NULL    |                |
| pwd         | varchar(64) | NO   |     | NULL    |                |
| groupid     | int(11)     | YES  |     | NULL    |                |
| authKey     | varchar(64) | YES  |     | NULL    |                |
| accessToken | varchar(64) | YES  |     | NULL    |                |
| logtime     | int(11)     | YES  |     | NULL    |                |
| logip       | varchar(64) | YES  |     | NULL    |                |
| enable      | tinyint(1)  | NO   |     | 0       |                |
+-------------+-------------+------+-----+---------+----------------+
10 rows in set (0.00 sec)
        */
    }


}

