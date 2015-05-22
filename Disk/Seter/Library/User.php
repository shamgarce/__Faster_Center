<?php

namespace Seter\Library;

class User{
    private $db = null;





    public function __construct(){
    }




    public function test(){
    }

//    public function __set($a, $b) {
//    }
//
//    public function __get($tablename) {
//    }


    //用户表标准格式
    public function columns()
    {
        /*
         * show columns from f_user;
mysql> show columns from f_user;
+-------------+-------------+------+-----+---------+----------------+
| Field       | Type        | Null | Key | Default | Extra          |
+-------------+-------------+------+-----+---------+----------------+
| uid         | int(11)     | NO   | PRI | NULL    | auto_increment |
| uname       | varchar(32) | NO   | UNI | NULL    |                |
| tname       | varchar(32) | YES  |     | NULL    |                |
| pwd         | varchar(64) | NO   |     | NULL    |                |
| authKey     | varchar(64) | YES  |     | NULL    |                |
| accessToken | varchar(64) | YES  |     | NULL    |                |
| logtime     | int(11)     | YES  |     | NULL    |                |
| logip       | varchar(64) | YES  |     | NULL    |                |
| enable      | tinyint(1)  | NO   |     | 0       |                |
+-------------+-------------+------+-----+---------+----------------+
9 rows in set (0.00 sec)
        */
    }


}

