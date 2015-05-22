<?php
class User extends MpModel
{
    public function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
    }

    //添加信息
    public function getuserlist($def = '')
    {
        switch($def){
            case '9999':
                return $this->Seter->table->f_user->where('enable = 0')->order('uid desc')->getall();
            break;
            case 1:
                return $this->Seter->table->f_user->where('enable = 1')->order('uid desc')->getall();
            break;
            default:    //0 全部
                return $this->Seter->table->f_user->order('uid desc')->getall();
            break;
        }

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





    public function columns()
    {
/*
 * show columns from f_user
+---------+-------------+------+-----+---------+----------------+
| Field   | Type        | Null | Key | Default | Extra          |
+---------+-------------+------+-----+---------+----------------+
| uid     | int(11)     | NO   | PRI | NULL    | auto_increment |
| uname   | varchar(32) | NO   | UNI | NULL    |                |
| tname   | varchar(32) | YES  |     | NULL    |                |
| pwd     | varchar(64) | NO   |     | NULL    |                |
| logtime | int(11)     | YES  |     | NULL    |                |
| logip   | varchar(64) | YES  |     | NULL    |                |
| lock    | tinyint(1)  | NO   |     | 0       |                |
+---------+-------------+------+-----+---------+----------------+
*/
    }

}


