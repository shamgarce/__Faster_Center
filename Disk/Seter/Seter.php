<?php

/*
 * 调用
 * include('Seter/Seter.php');
 * */

namespace Seter;

//use Seter\RedBeanPHP;


define(SHAM_PATH,__DIR__);

!empty($_GET)   && define('ISGET',TRUE);
!empty($_POST)  && define('ISPOST',TRUE);

!defined('ISGET')   && define('ISGET',false);
!defined('ISPOST')  && define('ISPOST',false);


include(__DIR__.'\Fun.php');

include(__DIR__.'\Sham\SeterBase.php');

include(__DIR__.'\Config.php');



class Seter extends \Seter\Sham\SeterBase{
    /*
     * 单例调用
     * */
    private static $instance    = null;         //单例调用
    /*
     * trace记录
     * 调用: \Sham\trace($info='')
     * \Sham\gettrace()
     * */
    public static $trace        = array();      //trace记录
    public  $dec        = 123;      //trace记录
    /*
     * 用户信息
     * */
    private $identify = array();                //用户识别
    /*
     * 配置
     * */
    public $Config = array();

    public function __construct($items = array())
    {
//        $this->singleton('PHPExcel', function ($c) {
//            return new PHPExcel();
//        });

        include(__DIR__.'\Config.php');
        $this->Config = $Config;

        $this->singleton('db', function ($c) {
            return new \Seter\Library\SDb();
        });


        $this->singleton('request', function ($c) {
            return new \Seter\Library\Request();
        });
        $this->singleton('table', function ($c) {
            return new \Seter\Library\Table();
        });

        $this->singleton('user', function ($c) {
            return new \Seter\Library\User();
        });
        //是否登陆
        $this->singleton('isguest', function () {
            if(!empty($this->identify)){
                return true;
            }else{
                return false;
            }
        });
    }


    public static function sterini()
    {
    }

    public static function getInstance(){
        !(self::$instance instanceof self)&&self::$instance = new self();
        return self::$instance;
    }

    public static function autoload($className)
    {
        $thisClass = str_replace(__NAMESPACE__ . '\\', '', __CLASS__);
        $baseDir = __DIR__;
        if (substr($baseDir, -strlen($thisClass)) === $thisClass) {
            $baseDir = substr($baseDir, 0, -strlen($thisClass));
        }

        $className = ltrim($className, '\\');
        $fileName = $baseDir;
        $namespace = '';
        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
//        echo $fileName;
        if (file_exists($fileName)) {
            require $fileName;
        }
    }
    /**
     * Register Slim's PSR-0 autoloader
     */
    public static function registerAutoloader()
    {
        spl_autoload_register(__NAMESPACE__ . "\\Seter::autoload");
    }
}

\Seter\Seter::registerAutoloader();     //PSR-0
