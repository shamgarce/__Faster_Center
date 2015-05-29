<?php

namespace Seter\Library;
//用户模型
/*
 * 暂时的功能局限到获取自己的信息
 * 调用
 * \Seter\Seter::getInstance()->user->isguest()
 * \Seter\Seter::getInstance()->user->myinfo()
 * \Seter\Seter::getInstance()->user->mygroup()
 *
 * //操作
 * //========================================
 * add edit     以后再写
 * //========================================
 * login
 * logout
 *
 *
 *
 * isguest
 * uname
 * tnamne
 * groupid
 * myinfo
 *
 *
 * */
class User
{
    public function __construct()
    {
        $this->S = \Seter\Seter::getInstance();
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

//    public $isguest= true;
//    public $isguest= true;

    /*
     * =============================================================
     *     //针对当前用户
     * =============================================================
     * */
    public $tablename   = 'f_user';
    public $uid         = 'uid';
    public $fileduname  = 'uname';
    public $filedtname  = 'tname';
    public $filedpwd    = 'pwd';
    public $filedauthkey= 'authkey';

    public $filedgroupid= 'groupid';
    public $filedenable = 'enable';

    public $fileloginip = 'logip';
    public $filelogintm = 'logtime';
    //* =============================================================
    public $identity = array();
    public $isguest = true;

//    public $uname = '';
//    public $tname = '';
//    public $authKey = '';
//    public $groupid = '';
//    public $authKey = '';
//    public $accessToken = '';

    //登陆
    public function login($uname,$pwd)
    {
        $tablename = $this->tablename;
        if($this->Isnotempty($uname) && $this->Isnotempty($pwd)){
            $uname = \Sham::saddslashes($uname);
            $row = $this->S->table->$tablename->where($this->fileduname." = '{$uname}'")->getrow();
            if(empty($row)){
                $this->S->json = true;
                $this->S->jsonarr = array(
                    'code'=>-200,
                    'msg'=>'户名不存在',
                );
                return false;
            }else{

                if($row[$this->filedpwd] == $this->S->hash($pwd)){
                    //禁用的用户
                    if($row[$this->filedenable]!=1){
                        $this->S->json = true;
                        $this->S->jsonarr = array(
                            'code'=>-200,
                            'msg'=>'无效用户',
                        );
                        return false;
                    }
                    //更改登陆信息
                    $ar = array(
                        $this->fileloginip  =>  \Sham::GetIP(),
                        $this->filelogintm  =>  \Sham::T(),
                    );
                    //更改数据库激励
                    $this->S->table->$tablename->where($this->fileduname." = '{$uname}'")->update($ar);
                    //日志记录

                    //dolog
                    //算法验证保证COOKIE安全
                    //$filedauthkey  $filedgroupid
                    $tm = time();
                    $signnature = \Sham::signnature($row[$this->fileduname].$row[$this->filedtname].$row[$this->filedauthkey].$row[$this->filedgroupid].$tm);;
                    \Sham::setcookie('uname',$row[$this->fileduname]);
                    \Sham::setcookie('tname',$row[$this->filedtname]);
                    \Sham::setcookie('authkey',$row[$this->filedauthkey]);
                    \Sham::setcookie('groupid',$row[$this->filedgroupid]);

                    \Sham::setcookie('tm',$tm);                     //记录时间
                    \Sham::setcookie('signature',$signnature);      //签名算法
                    return true;
                }else{
                    $this->S->json = true;
                    $this->S->jsonarr = array(
                        'code'=>-200,
                        'msg'=>'密码错',
                    );
                    return false;
                }


            }
        }else{
            $this->S->json = true;
            $this->S->jsonarr = array(
                'code'=>-200,
                'msg'=>'用户名密码不能为空',
            );
            return false;
        }
    }

    //登出
    public function logout()
    {
        return true;
    }


    public function Validator()
    {
        return true;
    }



    //
    public function identity()
    {
    }

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


    //是否空 存在返回true
    public function Isnotempty($str)
    {
        if(empty($str)){
            return false;
        }else{
            return true;
        }
    }

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

