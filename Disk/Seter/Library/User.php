<?php
namespace Seter\Library;
//用户模型
/*
 * 暂时的功能局限到获取自己的信息
 * 调用
 * $S = \Seter\Seter::getInstance();
 * $S->user->login()
 * $S->user->loginout()
 * $S->user->myinfo()       //获取我的信息
 * $S->user->islogin()      //是否登陆
 *
 *
 * 调用
 *
 *
 *
 *
 *
 * //操作
 * //========================================
 * add edit     以后再写
 * //========================================
 * login
 * logout
 * isguest
 * islogin
 *
 * uname
 * tnamne
 * groupid
 * myinfo
 *
 * */
class User
{

    public $loginurl    = '/manage/home.login';
    public $logout      = '/manage/home.loginout';
    public $logingo     = '/manage/';

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
    public $identity    = array();
    public $isguest     = true;
    public $json        = array();

    public function __construct($tablename = '')
    {
        $this->tablename = $tablename;
        $this->S = \Seter\Seter::getInstance();
    }

    //登陆
    public function login($uname,$pwd)
    {
        $tablename = $this->tablename;
        if($this->Isnotempty($uname) && $this->Isnotempty($pwd)){
            $uname = \Sham::saddslashes($uname);
            $row = $this->S->table->$tablename->where($this->fileduname." = '{$uname}'")->getrow();
            if(empty($row)){
                $this->json(array(
                    'code'=>-200,
                    'msg'=>'户名不存在',
                ));
                return false;
            }else{

                if($row[$this->filedpwd] == $this->hash($pwd)){
                    //禁用的用户
                    if($row[$this->filedenable]!=1){
                        $this->json(array(
                            'code'=>-200,
                            'msg'=>'无效用户',
                        ));
                        return false;
                    }

                    $this->loginrow($row);          //标记登陆信息
                    return true;
                }else{
                    $this->json(array(
                        'code'=>-200,
                        'msg'=>'密码错',
                    ));
                    return false;
                }


            }
        }else{
            $this->json(array(
                'code'=>-200,
                'msg'=>'用户名密码不能为空2',
            ));
            return false;
        }
        echo 123;
    }

    /*
     * 中间过程
     *
     * @result bool
     * */
    public function loginrow($row = array())
    {
        //更改登陆信息
        $ar = array(
            $this->fileloginip  =>  \Sham::GetIP(),
            $this->filelogintm  =>  \Sham::T(),
        );
        //更改数据库激励
        $tablename = $this->tablename;
        $this->S->table->$tablename->where($this->fileduname." = '{$row[$this->fileduname]}'")->update($ar);
        //日志记录
        $tm = time();
        $signature = \Sham::signnature($row[$this->fileduname].$row[$this->filedtname].$row[$this->filedauthkey].$row[$this->filedgroupid].$tm);;
        setCookie('user_uname',$row[$this->fileduname],$tm+604800,'/');
        setCookie('user_tname',$row[$this->filedtname],$tm+604800,'/');
        setCookie('user_authkey',$row[$this->filedauthkey],$tm+604800,'/');
        setCookie('user_groupid',$row[$this->filedgroupid],$tm+604800,'/');

        setCookie('user_tm',$tm,$tm+604800,'/');                     //记录时间
        setCookie('user_signature',$signature,$tm+604800,'/');      //签名算法
        return true;
    }

    //登出
    public function logout()
    {
        setCookie('user_uname',$row[$this->fileduname],$tm-1,'/');
        setCookie('user_tname',$row[$this->filedtname],$tm-1,'/');
        setCookie('user_authkey',$row[$this->filedauthkey],$tm-1,'/');
        setCookie('user_groupid',$row[$this->filedgroupid],$tm-1,'/');
        setCookie('user_tm',$tm,$tm-1,'/');                     //记录时间
        setCookie('user_signature',$signature,$tm-1,'/');      //签名算法
        return true;
    }

    public function islogin()
    {
        $uname      = cookie('user_uname');
        $tname      = cookie('user_tname');
        $authkey    = cookie('user_authkey');
        $groupid    = cookie('user_groupid');
        $tm         = cookie('user_tm');             //记录时间
        $signature  = cookie('user_signature');      //签名算法
        if($signature == \Sham::signnature($uname.$tname.$authkey.$groupid.$tm)){
            return true;
        }else{
            return false;
        }
    }

    //是否空 存在返回true
    public function Isnotempty($str)
    {
        if(empty($str)){
            return false;
        }else{
            return true;
        }
    }

    public function hash($str)
    {
        return md5($str);
    }

    /*操作结果反倒->json中
    通过go输出
     * */

    public function json($ar)
    {
        !empty($ar['code']) && $this->json['code'] = $ar['code'];
        !empty($ar['msg'])  && $this->json['msg']  = $ar['msg'];
        !empty($ar['data']) && $this->json['data'] = $ar['data'];
    }

    /*
     * 对这里不应该有输出，输出应该放到v层中，这里只返回true、false、和提示数据
     * */
    //输出json结果
    public function go()
    {
        echo json_encode($this->json);
        exit;
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
| creattime   | int(11)     | YES  |     | NULL    |                |
| logtime     | int(11)     | YES  |     | NULL    |                |
| logip       | varchar(64) | YES  |     | NULL    |                |
| enable      | tinyint(1)  | NO   |     | 0       |                |
+-------------+-------------+------+-----+---------+----------------+
11 rows in set (0.00 sec)
        */
    }

}

