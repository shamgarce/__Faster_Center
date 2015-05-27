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

include(__DIR__.'\Config.php');


!defined('BTIME')  && define('BTIME', \Sham::T());

class Seter implements \ArrayAccess, \Countable, \IteratorAggregate
{
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
    /**
     * Key-value array of arbitrary data
     * @var array
     */
    public $data = array();

    public function __construct($items = array())
    {
//        $this->singleton('PHPExcel', function ($c) {
//            return new PHPExcel();
//        });

        include(__DIR__.'\Config.php');
        $this->Config = $Config;

        $this->singleton('ry', function ($c) {
            return new \Seter\Library\ServerAPI('8luwapkvufd1l','428XgqSUvxeAzr');
        });



        $this->singleton('db', function ($c) {
            return new \Seter\Library\SDb();
        });

        $this->singleton('mdb', function ($c) {
            return new \Seter\Library\Mdb();
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



    /**
     * Normalize data key
     *
     * Used to transform data key into the necessary
     * key format for this set. Used in subclasses
     * like \Slim\Http\Headers.
     *
     * @param  string $key The data key
     * @return mixed       The transformed/normalized data key
     */
    protected function normalizeKey($key)
    {
        return $key;
    }

    /**
     * Set data key to value
     * @param string $key   The data key
     * @param mixed  $value The data value
     */
    public function set($key, $value)
    {
        $this->data[$this->normalizeKey($key)] = $value;
    }

    /**
     * Get data value with key
     * @param  string $key     The data key
     * @param  mixed  $default The value to return if data key does not exist
     * @return mixed           The data value, or the default value
     */
    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            $isInvokable = is_object($this->data[$this->normalizeKey($key)]) && method_exists($this->data[$this->normalizeKey($key)], '__invoke');

            return $isInvokable ? $this->data[$this->normalizeKey($key)]($this) : $this->data[$this->normalizeKey($key)];
        }

        return $default;
    }

    /**
     * Add data to set
     * @param array $items Key-value array of data to append to this set
     */
    public function replace($items)
    {
        foreach ($items as $key => $value) {
            $this->set($key, $value); // Ensure keys are normalized
        }
    }

    /**
     * Fetch set data
     * @return array This set's key-value data array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * Fetch set data keys
     * @return array This set's key-value data array keys
     */
    public function keys()
    {
        return array_keys($this->data);
    }

    /**
     * Does this set contain a key?
     * @param  string  $key The data key
     * @return boolean
     */
    public function has($key)
    {
        return array_key_exists($this->normalizeKey($key), $this->data);
    }

    /**
     * Remove value with key from this set
     * @param  string $key The data key
     */
    public function remove($key)
    {
        unset($this->data[$this->normalizeKey($key)]);
    }

    /**
     * Property Overloading
     */

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    public function __isset($key)
    {
        return $this->has($key);
    }

    public function __unset($key)
    {
        return $this->remove($key);
    }

    /**
     * Clear all values
     */
    public function clear()
    {
        $this->data = array();
    }

    /**
     * Array Access
     */

    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * Countable
     */

    public function count()
    {
        return count($this->data);
    }

    /**
     * IteratorAggregate
     */

    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Ensure a value or object will remain globally unique
     * @param  string  $key   The value or object name
     * @param  Closure        The closure that defines the object
     * @return mixed
     */
    public function singleton($key, $value)
    {

        $this->set($key, function ($c) use ($value) {
            static $object;
            if (null === $object) {
                $object = $value($c);
            }
            return $object;
        });
    }

    /**
     * Protect closure from being directly invoked
     * @param  Closure $callable A closure to keep from being invoked and evaluated
     * @return Closure
     */
    public function protect(Closure $callable)
    {
        return function () use ($callable) {
            return $callable;
        };
    }

    function __call($function_name, $args)
    {
        echo "function: $function_name (<br />";
        var_dump($args);
        echo ") not exist！";
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
