<?php




class WoniuController extends MpLoaderPlus {
    private static $instance;
    public function __construct() {
        self::$instance = &$this;
        $this->autoload();
        parent::__construct();
    }
    private function autoload() {
        $system = systemInfo();
        $autoload_helper = $system['helper_file_autoload'];
        $autoload_library = $system['library_file_autoload'];
        $autoload_models = $system['models_file_autoload'];
        foreach ($autoload_helper as $val) {
            if (is_array($val)) {
                $key = key($val);
                $val = $val[$key];
                $this->helper($key,$val);
            } else {
                $this->helper($val);
            }
        }
        foreach ($autoload_library as $key => $val) {
            if (is_array($val)) {
                $new = isset($val['new']) ? $val['new'] : true;
                $key = key($val);
                $val = $val[$key];
                $this->lib($key, $val, $new);
            } else {
                $this->lib($val);
            }
        }
        foreach ($autoload_models as $key => $val) {
            if (is_array($val)) {
                $key = key($val);
                $val = $val[$key];
                $this->model($key, $val);
            } else {
                $this->model($val);
            }
        }
        /**
         * 如果使用了自定义缓存驱动，加载相应的文件
         */
        static $included = array();
        foreach ($system['cache_drivers'] as $filepath) {
            $file = pathinfo($filepath, PATHINFO_BASENAME);
            $namex = str_replace(".php", "", $file);
            //只include选择的缓存驱动文件
            if ($namex == $system['cache_config']['storage']) {
                if (!isset($included[truepath($filepath)])) {
                    MpLoader::includeOnce($filepath);
                } else {
                    $included[truepath($filepath)] = 1;
                }
            }
        }
    }
    public static function &getInstance() {
        return self::$instance;
    }
    /**
     * 实例化一个控制器
     * @staticvar array $loadedClasses
     * @param type $classname_path
     * @param type $hmvc_module_floder
     * @return WoniuController
     */
    public static function instance($classname_path = null, $hmvc_module_floder = NULL) {
        if (!empty($hmvc_module_floder)) {
            MpRouter::switchHmvcConfig($hmvc_module_floder);
        }
        if (empty($classname_path)) {
            MpLoader::classAutoloadRegister();
            return new self();
        }
        $system = systemInfo();
        $classname_path = str_replace('.', DIRECTORY_SEPARATOR, $classname_path);
        $classname = basename($classname_path);
        $filepath = $system['controller_folder'] . DIRECTORY_SEPARATOR . $classname_path . $system['controller_file_subfix'];
        $alias_name = strtolower($classname);
        static $loadedClasses = array();
        if (in_array($alias_name, array_keys($loadedClasses))) {
            return $loadedClasses[$alias_name];
        }
        if (file_exists($filepath)) {
            //在plugin模式下，路由器不再使用，那么自动注册不会被执行，自动加载功能会失效，所以在这里再尝试加载一次，
            //如此一来就能满足两种模式
            MpLoader::classAutoloadRegister();
            MpLoader::includeOnce($filepath);
            if (class_exists($classname, FALSE)) {
                return $loadedClasses[$alias_name] = new $classname();
            } else {
                trigger404('Ccontroller Class:' . $classname . ' not found.');
            }
        } else {
            trigger404($filepath . ' not found.');
        }
    }
}


class MpController extends WoniuController{

}
/* End of file Controller.php */
