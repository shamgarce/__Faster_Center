<?php

/**
 * Class F
 * 这个是入口文件
 * 第一执行的是F::ini
 *
 */
class F extends Base {

    private $props = array();
    public static $instance;
    public function __construct(){
        parent::__construct();
    }

    public function setProperty($key,$val){
        $this->props[$key] = $val;
    }

    public function getProperty($key){
        return $this->props[$key];
    }

//        $system = systemInfo();
//        date_default_timezone_set($system['default_timezone']);
//        $this->registerErrorHandle();
//        $this->router = MpInput::$router;
//        $this->input = new MpInput();
//        $this->model = new WoniuModelLoader();
//        $this->lib = new WoniuLibLoader();
        //程序入口





    public static function run()
    {
        $env = new Env();           //在construct中完成所有初始化操作      //第一方法


        //constrollers 的初始化方法
//        $system = systemInfo();						//配置信息
//        date_default_timezone_set($system['default_timezone']);
//        $this->registerErrorHandle();
//        $this->router = MpInput::$router;
//        $this->input = new MpInput();
//        $this->model = new WoniuModelLoader();
//        $this->lib = new WoniuLibLoader();
////		if (class_exists('MpRule', FALSE)) {
////			$this->rule = new MpRule();
////		}
////		if (class_exists('phpFastCache', false)) {
////			$this->cache = phpFastCache::getInstance($system['cache_config']['storage'], $system['cache_config']);
////		}
////		if ($system['autoload_db']) {
////			$this->database();
////		}
//        stripslashes_all();




//        $system = systemInfo();
//        $methodInfo = self::parseURI();

        //print_r($methodInfo);
        //在解析路由之后，就注册自动加载，这样控制器可以继承类库文件夹里面的自定义父控制器,实现hook功能，达到拓展控制器的功能
        //但是plugin模式下，路由器不再使用，那么这里就不会被执行，自动加载功能会失效，所以在每个instance方法里面再尝试加载一次即可，
        //如此一来就能满足两种模式
//        MpLoader::classAutoloadRegister();
//        if (file_exists($methodInfo['file'])) {
//            include $methodInfo['file'];
//            MpInput::$router = $methodInfo;
//            if (!MpInput::isCli()) {
//                //session自定义配置检查,只在非命令行模式下启用
//                self::checkSession();
//            }



//            $class = new $methodInfo['class']();
//            if (method_exists($class, $methodInfo['method'])) {
//                $methodInfo['parameters'] = is_array($methodInfo['parameters']) ? $methodInfo['parameters'] : array();
//                //echo 'action before';
//                if (method_exists($class, '__output')) {
//                    ob_start();
//                    call_user_func_array(array($class, $methodInfo['method']), $methodInfo['parameters']);
//                    $buffer = ob_get_contents();
//                    @ob_end_clean();
//                    call_user_func_array(array($class, '__output'), array($buffer));
//                } else {
//                    call_user_func_array(array($class, $methodInfo['method']), $methodInfo['parameters']);
//                }
//                //echo 'action after';
//            } else {
//                trigger404($methodInfo['class'] . ':' . $methodInfo['method'] . ' not found.');
//            }
//        } else {
//            if ($system['debug']) {
//                trigger404('file:' . $methodInfo['file'] . ' not found.');
//            } else {
//                trigger404();
//            }
//        }











    }



}


//
//$base = new F();
//$base['s'] = 999;       //set
//$base['s2'] = 999;       //set
//
//foreach($base as $key => $item){
//    echo "{$key} => {$item} \n";
//}
//
//var_dump(count($base));
//
//echo $base->count();
////unset($base['s']);      //unset
////echo isset($base['s']); //isset
////echo $base['s'] ;       //get
//
//
//
//










/* End of file Router.php */