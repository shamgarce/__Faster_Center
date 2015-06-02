<?php
use \Seter\Sham;

//两种方式和模式
/*
1、过滤器模式 有结果容器，存储运算结果，       进行过滤运算
2、单线程模式 也就是最终的原子操作
//两种形式用统一的结果容器
1 :////////////////
*/

/*
 * 1 : 文档系统，提供原子数据的查询
 * 2 ：构建原子方法
 * 3 ：更多的底层函数
 *
 * 服务层和原子层
 *
 * 4 ：
 * 设置
 * error_reporter
 * moduleslist
 * debug
 * routetype
$system['debug'] = true;
$system['autoload_db'] = false;
/**
 * --------------------系统配置-------------------------
//$system['application_folder'] = dirname(__FILE__);
//$system['controller_folder'] = $system['application_folder'] . '/controllers';
//$system['model_folder'] = $system['application_folder'] . '/models';
//$system['view_folder'] = $system['application_folder'] . '/views';
//$system['library_folder'] = $system['application_folder'] . '/library';
//$system['helper_folder'] = $system['application_folder'] . '/helper';
////$system['error_page_404'] = 'application/error/error_404.php';
////$system['error_page_50x'] = 'application/error/error_50x.php';
////$system['error_page_db'] = 'application/error/error_db.php';
////$system['message_page_view'] = '';
//$system['default_controller']       = 'home';
//$system['default_controller_method'] = 'index';
//$system['controller_method_prefix'] = 'do';
//$system['controller_file_subfix']   = '.php';
//$system['model_file_subfix']        = '.model.php';
//$system['view_file_subfix']         = '.view.php';
//$system['library_file_subfix']      = '.class.php';
//$system['helper_file_subfix']       = '.php';
 * 登陆地址
 * 登出地址
 * 登陆之后的跳转地址
 * 404错误地址
 * 500错误地址
 * 其他错误地址
 * 数据库错误地址
 *
 *
 *
 *
 * 原子数据
 * $this->route
 * $this->get
 * $this->post
 * $this->cookie
 *
 * 原子过程
 * $this->error(404);
 * $this->error(500);
 * $this->R();
// * $this->login();
// * $this->loginlogout();
// * $this->logingo();

 * $this->config();     //获取配置
 * $this->behaviors();  //获取验证权限    // 配合用户对象 配合设置的信息
 *
 * $this->R();
 * $this->view("home/index",$data);     //加载视图和数据
 * $this->json($data);                  //json输出
 *
 *
 * 服务对象
 * $this->user  //用户数据
 * $this->db
 * $this->mdb
 * $this->model->       //模型调用
 *
 * */




/**
 * Description of index
 *
 * @author Administrator
 */
class Home extends MpController {
    function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
//print_r($this->router);
//print_r(\WoniuRouter::parseURI());

//        //$instance = MpController::getInstance();
//        //var_dump($instance->Seter);
//        \Sham::trace(__METHOD__);             //执行路径记录
//        print_r(\Sham::gettrace());           //显示
    }


    //behaviors 行为
    /*
     * class 和 mothod 已经确定
     * 对照权限表，进行授权
     * 权限分三种  deny 、access 、 verbs
     * only     //对动作类型进行约束 符合条件的
     * rules   //制定规则
     *
     * */

//*: 任何用户，包括匿名和验证通过的用户。
//?: 匿名用户。
//@: 验证通过的用户。
    public function behaviors()
    {
        return [
            'allow' => [
                'only' => ['logout'],                           //范围
                'rules' => [                                    //规则
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'deny' => [
                //'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

            'verbs' => [
                //'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];

//        array('deny',
//            'actions'=>array('create', 'edit'),
//            'users'=>array('?'),
//        ),
//            array('allow',
//                'actions'=>array('delete'),
//                'roles'=>array('admin'),
//            ),
//            array('deny',
//                'actions'=>array('delete'),
//                'users'=>array('*'),
//            ),





    }

    //用文件定义方法
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
//        ];
//    }



    /*
     * 首页
     * */
    public function doIndex($name = '') {
        $ms = $this->behaviors();
        print_r($ms);
        print_r($this->router);
        echo '----------------------';

        $class = strtolower(__CLASS__);
        $mothed_ = strtolower(__METHOD__);
        //'::do'

        echo $mothed;

exit;
        $data=array(
            'title'=>'仪表盘'
        );
        $this->view("home/index",$data);
    }


    //登出
    public function doLogout() {
        $this->Seter->user->logout();
        \Sham::R($this->Seter->user->loginurl);
    }




    public function doDisplay() {
////        echo         $this->input->cookie('test1');
////exit;
////        set_cookie('vvvvvv','123123123123');
////        echo         $this->input->cookie('vvvvvv');
////
////        exit;
////        echo         $this->input->cookie('Seter_uname');
////        ///setcookie('sdf',123);
////        print_r($_COOKIE);
//        echo         $this->input->cookie('use1');
//        print_r($_COOKIE);
//        $this->Seter->user->display();
//
////        echo $this->Seter->user->islogin();
////        echo $this->Seter->user->isguest();
//        exit;
//        var_dump($this->input);
//        print_r($this->input->cookie());
//        print_r($_COOKIE);
//        $this->Seter->user->display();
    }
//
//    public function doDisplay() {
//        var_dump($this->input);
//        print_r($this->input->cookie());
//        print_r($_COOKIE);
//        $this->Seter->user->display();
//        echo '<hr>';
//        $this->Seter->user->isguest();
//        echo         $this->Seter->user->isguest;
//        echo         $this->Seter->user->islogin();
//
//
//
//    }



    public function doLogin() {

        //$this->Seter->user->logingo = '/doc/home.index';

        if(ISPOST){
            //登陆动作
            $this->model->logintest->load($this->Seter->request->post)->login();
        }

        $re = $this->Seter->request->get['re'];
        if(empty($re)) $re = $this->Seter->user->logingo;
        $data=array(
            'title'=>'测试登陆',
//            'url' => $this->Seter->user->logingo,             //默认地址
            're' => $re,           //登陆之后的地址
        );
        $this->view("home/login",$data);
    }


    /*
     * 测试内容
     * */
    public function doUserlist($flit = '0') {
        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post)->cflag();
        }
        $data=array(
            'userlist' => $this->model->user->getuserlist($flit),
            'title'=>'用户列表'
        );
        $this->view("home/userlist",$data);
        echo 1;
    }

    /*
     * 添加用户
     * */
    public function doUseradd() {

        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post)->add();
        }
        $data=array(
            'title'=>'添加用户'
        );
        $this->view("home/dialog/useradd",$data);
    }

    /*
     * 修改用户
     * */
    public function doUseredit($uid = 0)
    {
        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post)->update();
//            $this->model->formuser->load() && $this->model->formuser->update();
            $this->gojson();
        }else{
            $data=array(
                'user' => $this->Seter->table->f_user->where("uid = $uid")->getrow(),
                'title'=>'修改用户'
            );
            $this->view("home/dialog/useredit",$data);
        }
    }

    public function doDialog()
    {
        $this->model->user->test();
        $dialog = array();
        $dialog[] = array(
            'title' => '添加用户',
            'uri'   => '/manage/home.useradd',
        );
        $dialog[] = array(
            'title' => '编辑用户',
            'uri'   => '/manage/home.useredit',
        );


        $data['dialog'] = $dialog;
        $this->view("home/dialog",$data);
    }



    //输出json
    public $isjson = false;
    public $jsoncode = 0;
    public $jsonmsg = '';
    public $jsondata = array();
	public function gojson(){
		$res = array(
			'code'	=> $this->jsoncode,
			'msg'	=> $this->jsonmsg,
			'data'	=> $this->jsondata
		);
		if($this->isjson){
            echo json_encode($res);
            exit;
        }
	}

}

