<?php

/**
 * 第一时间实例化的对象，所以要尽早收集有用信息
 */

class Env extends Base{


    /**
     * @var array
     */
    protected $properties;

    protected $server   = array();
    protected $get      = array();
    protected $post     = array();
    protected $cookies  = array();

    /**
     * @var \Slim\Environment
     */
    protected static $environment;

    /**
     * Get environment instance (singleton)
     *
     * This creates and/or returns an environment instance (singleton)
     * derived from $_SERVER variables. You may override the global server
     * variables by using `\Slim\Environment::mock()` instead.
     *
     * @param  bool             $refresh Refresh properties using global server variables?
     * @return \Slim\Environment
     */
    public static function getInstance($refresh = false)
    {
        if (is_null(self::$environment) || $refresh) {
            self::$environment = new self();
        }

        return self::$environment;
    }



    public static function handleErrors($errno, $errstr = '', $errfile = '', $errline = '')
    {
//        if (!($errno & error_reporting())) {
//            return;
//        }
        throw new \ErrorException($errstr.'123123123123', $errno, 0, $errfile, $errline);
    }


    /**
     * Constructor (private access)
     *
     * @param  array|null $settings If present, these are used instead of global server variables
     */
    public function __construct()
    {


//        $this->error = function(){
//            return new Error();
//        };

        //Error::E404();
        //Error::J404();
        //Error::E500('发生一个错误');
        //Error::J500('发生一个错误');
        //Error::J(200,'ok',array('u'=>1));
        //Error::E('内容');

        $this->server   = static::stripslashes2($_SERVER);
        $this->get      = static::stripslashes2($_GET);
        $this->post     = static::stripslashes2($_POST);
        $this->cookies  = static::stripslashes2($_COOKIE);


//        $_GET 		= shtmlspecialchars($_GET);
//        $_POST 		= shtmlspecialchars($_POST);
//        $_COOKIE 	= shtmlspecialchars($_COOKIE);
////===============================================================
////运算3
//        if (!isset($_SERVER['REQUEST_URI'])) {
//            $_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'];
//            if (isset($_SERVER['QUERY_STRING']))
//                $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
//        }
//        if ($_SERVER['REQUEST_URI']) {
//            $temp = urldecode($_SERVER['REQUEST_URI']);
//            if (strexists($temp, '<') || strexists($temp, '"')) {
//                $_GET = shtmlspecialchars($_GET); //XSS
//            }
//        }
//
//


        !$this->is_php('5.3') && Error::E('PHP版本必须在5.3以上');


echo 'mark';

//            $env = array();
//
//            //The HTTP request method
//            $env['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD'];
//
////            //The IP
//            $env['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
//
////            // Server params
//            $scriptName = $_SERVER['SCRIPT_NAME']; // <-- "/foo/index.php"
//            $requestUri = $_SERVER['REQUEST_URI']; // <-- "/foo/bar?test=abc" or "/foo/index.php/bar?test=abc"
//            $queryString = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : ''; // <-- "test=abc" or ""
//
//            // Physical path
//            if (strpos($requestUri, $scriptName) !== false) {
//                $physicalPath = $scriptName; // <-- Without rewriting
//            } else {
//                $physicalPath = str_replace('\\', '', dirname($scriptName)); // <-- With rewriting
//            }
//            $env['SCRIPT_NAME'] = rtrim($physicalPath, '/'); // <-- Remove trailing slashes
//
//            // Virtual path
//            $env['PATH_INFO'] = substr_replace($requestUri, '', 0, strlen($physicalPath)); // <-- Remove physical path
//            $env['PATH_INFO'] = str_replace('?' . $queryString, '', $env['PATH_INFO']); // <-- Remove query string
//            $env['PATH_INFO'] = '/' . ltrim($env['PATH_INFO'], '/'); // <-- Ensure leading slash
//
//            // Query string (without leading "?")
//            $env['QUERY_STRING'] = $queryString;
////
//            //Name of server host that is running the script
//            $env['SERVER_NAME'] = $_SERVER['SERVER_NAME'];
////
//            //Number of server port that is running the script
//            //$env['SERVER_PORT'] = $_SERVER['SERVER_PORT'];
//
//            //开始时间
//            $env['REQUEST_TIME_FLOAT'] = $_SERVER['REQUEST_TIME_FLOAT'];
//
////
////            //HTTP request headers (retains HTTP_ prefix to match $_SERVER)
//print_r($_SERVER);
//
//            $headers = self::extract($_SERVER);
//
//            foreach ($headers as $key => $value) {
//                $env[$key] = $value;
//            }
//
//
//
//        print_r($env);
//
//            $this->properties = $env;


    }

    /**
     * @param $str
     * hash 算法
     */
    public static function hash($str,$salt='')
    {
        return empty($salt)?md5($str):MD5($str.$salt);
    }


    /**
     * @var
     * 版本检查
     */
    public function is_php($version = '5.4.0') {
        $version = (string) $version;
        return (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
    }

    /**
    +----------------------------------------------------------
     * // html实体转义
    +----------------------------------------------------------
     * 参数:string 需要转义的内容   反函数 htmldecode
    +----------------------------------------------------------
     */
    function shtmlspecialchars($string) {
        if (is_array($string)) {
            foreach ($string as $key => $val) {
                $string[$key] = shtmlspecialchars($val);
            }
        } else {
            $string = htmlspecialchars(strip_sql($string), ENT_QUOTES);
        }
        return $string;
    }

    /**
     * @param $var
     * @return array|string
     * 魔术反转义
     */
    public static function stripslashes2($var) {
        if (!get_magic_quotes_gpc()) {
            return $var;
        }
        if (is_array($var)) {
            foreach ($var as $key => $val) {
                if (is_array($val)) {
                    $var[$key] = static::stripslashes2($val);
                } else {
                    $var[$key] = stripslashes($val);
                }
            }
        } elseif (is_string($var)) {
            $var = stripslashes($var);
        }
        return $var;
    }






//    protected static $special = array(
//        'CONTENT_TYPE',
//        'CONTENT_LENGTH',
//        'PHP_AUTH_USER',
//        'PHP_AUTH_PW',
//        'PHP_AUTH_DIGEST',
//        'AUTH_TYPE',
//        'REQUEST_URI',
//        'SERVER_PORT',
//    );
//
//    public static function extract($data)
//    {
//        $results = array();
//        foreach ($data as $key => $value) {
//            $key = strtoupper($key);
//            if (strpos($key, 'X_') === 0 || strpos($key, 'HTTP_') === 0 || in_array($key, static::$special)) {
//                if ($key === 'HTTP_CONTENT_LENGTH') {
//                    continue;
//                }
//                $results[$key] = $value;
//            }
//        }
//        return $results;
//    }

}