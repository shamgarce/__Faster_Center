<?php
/*
 * RBAC 部分
 * 判断谁（Who）对什么（What/Which）进行怎样（How）

//da ：验证操作
//deny  拒绝
//allow 拒绝

//users: 设置哪个用户匹配此规则。
//此当前用户的name 被用来匹配，三种设定字符在这里可以用：
//*: 任何用户，包括匿名和验证通过的用户。
//?: 匿名用户。
//@: 验证通过的用户。

 *
 *
 * */
class Rbac extends MpModel
{
    public $Seter   = null;
    public $app     = null;
    public $router  = null;
    public $user    = null;


    /**
     * 四个验证的临时状态
     */
    public $da       = false;    //初始化 规则中rule[0]的限定范围是deny和allow 通过 ->true
    public $actions  = false;    //actions规则匹配状态 ->true
    public $users    = false;    //user规则匹配状态    ->true
    public $roles    = false;    //用户组规则匹配状态   ->true
    public $res     = false;     //链式操作临时结果集 $this->go() 输出   //true false

    public function __construct()
    {
        parent::__construct();
        $this->Seter    = \Seter\Seter::getInstance();
        $this->app      = MpController::getInstance();
        $this->router   = $this->app->router;
        $this->user   = $this->Seter->user->userinfo();
    }

//    public function accessRules()
//    {
//        return array(
//            array('deny',
//                'actions'=>array('create', 'edit'),
//                'users'=>array('?'),        //匿名
//            ),
//            array('allow',
//                'actions'=>array('delete'),
//                'roles'=>array('admin'),    //admin角色
//            ),
//            array('deny',
//                'actions'=>array('delete'),
//                'users'=>array('*'),        //任何
//            ),
//        );
//    }

    /**
     * @param $rules    规则
     * @return bool     true 通过 false未通过
     */
    //规则判定
    public function Rules($rules)
    {
        //从上到下，有一条匹配上则规则生效
        foreach($rules as $rule){
            $res = $this->Rulesone($rule);
            if($res) return $res;        //返回判定结果 deny allow
        }
    }

    /**
     * @param $da       //deny or allow
     * @param $actions  //规则动作
     * @param $users    //规则用户
     * @param $roles    //规则用户组
     * @return bool     //返回 deny/allow or false
     */
    public function Rulesone($rule)
    {

        $this->da       = false;    //初始化 规则中rule[0]的限定范围是deny和allow 通过 ->true
        $this->actions  = false;    //actions规则匹配上      通过 ->true
        $this->users    = false;    //user规则匹配上         通过      ->true
        $this->roles    = false;    //用户组规则匹配上        通过    ->true
        /**
         * da限定 [deny / allow]
         * actions 如果空 则匹配全部动作
         * users   如果空 则匹配全部用户
         * roles   如果空 则匹配全部用户组
         */
        //上面五个全部通过，则结果有效，返回数据，否则返回false
        $this->res      = false;
        //匹配一条规则 返回结果 下面的都通过链式操作
        return $this->Rulesone_da()->Rulesone_actions()->Rulesone_users()->Rulesone_roles()->go();;

//        $da
//        $actions
//        $users
//        $roles


        //1 、 匹配上返回 deny或者allow
        //2 、 false
        //========================================
        //匹配
        /*
         * $s['deny']['actions'] 能匹配上
         * $s['deny']['users'] 能匹配上
         * $s['deny']['roles'] 用户组
         *
         */
        //return $rule[$key];     //allow 或者deny
        return false;           //没有匹配上规则
    }


    private function Rulesone_da()
    {
//        $this->res = 'deny';
//        $this->res = 'allow';
        return $this;
    }
    private function Rulesone_actions()
    {
//        $this->res = 'deny';
//        $this->res = 'allow';
        return $this;
    }
    private function Rulesone_users()
    {
//        $this->res = 'deny';
//        $this->res = 'allow';
        return $this;
    }
    private function Rulesone_roles()
    {
//        $this->res = 'deny';
//        $this->res = 'allow';
        //用户组最后一个判定
        return $this;
    }
    private function go()
    {
        return $this->res;
    }

//allow，则动作可执行；
//deny，不能执行


// 以下匹配所有人规则拒绝'delete'动作
//array('deny',
//'action'=>'delete',
//),


//actions: 设置哪个动作匹配此规则。



//roles: 设定哪个角色匹配此规则。

}


