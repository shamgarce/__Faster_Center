<?php
namespace Seter;
//use Seter\RedBeanPHP;
define(SHAM_PATH,__DIR__);

include(__DIR__.'\Fun.php');
include(__DIR__.'\Sham\SeterBase.php');

//redbean
require_once(SHAM_PATH.'\plus\RedBean\rb.php');
\R::setup( 'mysql:host=127.0.0.1;dbname=ns','root', 'root3306' );


//$book = \R::load( 'dy_user', 1 );
//$book = \R::findAll( 'dy_user');
$books = \R::findAll( 'dy_user' );
foreach($books as $key=>$value){
    print_r($value);
    echo $value['user_id'];
}
exit;

class Seter extends \Seter\Sham\SeterBase{
    public function __construct($items = array())
    {
        // $this->replace($items);
//        $this->singleton('db', function ($c) {
//            return new Sham_Db();
//        });
////        $this->singleton('mdb', function ($c) {
////            return new Sham_Mdb();
////        });
//        $this->singleton('logmon', function ($c) {
//            return new Sham_Logmon();
//        });
//        $this->singleton('PHPExcel', function ($c) {
//            return new PHPExcel();
//        });
        $this->singleton('db', function ($c) {
            return new \Seter\Library\Db();
        });
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


$Seter = new \Seter\Seter();
var_dump($Seter->db);

//

//$user = new \Seter\Db\DbUser();
//
//$result = new \Seter\Db\Result();
//
//
////echo $user->isguest;
//
//
//
////$user->getbyid(12)->order(123);
//$user->getrowbyid(12)->set(array('vr'=>1))->update();
//$user->gerrow(12)->set(array('vr'=>1))->update();
//
//
//
////$user->getbyid(12)->order(123);
////
////
////$user->getbyname(12);
//
//
////var_dump($user);
//
//print_r($user->attributeLabels());
//
////echo Sham::T();
////echo 'mark';
////exit;