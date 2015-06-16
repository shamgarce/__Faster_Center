class WoniuRouter {
	public static function loadClass() {
		$system = systemInfo();
		$methodInfo = self::parseURI();

		print_r($methodInfo);
		//�ڽ���·��֮�󣬾�ע���Զ����أ��������������Լ̳�����ļ���������Զ��常������,ʵ��hook���ܣ��ﵽ��չ�������Ĺ���
		//����pluginģʽ�£�·��������ʹ�ã���ô����Ͳ��ᱻִ�У��Զ����ع��ܻ�ʧЧ��������ÿ��instance���������ٳ��Լ���һ�μ��ɣ�
		//���һ��������������ģʽ
		MpLoader::classAutoloadRegister();
		if (file_exists($methodInfo['file'])) {
			include $methodInfo['file'];
			MpInput::$router = $methodInfo;
			if (!MpInput::isCli()) {
				//session�Զ������ü��,ֻ�ڷ�������ģʽ������
				self::checkSession();
			}
			$class = new $methodInfo['class']();
			if (method_exists($class, $methodInfo['method'])) {
				$methodInfo['parameters'] = is_array($methodInfo['parameters']) ? $methodInfo['parameters'] : array();
				//echo 'action before';
				if (method_exists($class, '__output')) {
					ob_start();
					call_user_func_array(array($class, $methodInfo['method']), $methodInfo['parameters']);
					$buffer = ob_get_contents();
					@ob_end_clean();
					call_user_func_array(array($class, '__output'), array($buffer));
				} else {
					call_user_func_array(array($class, $methodInfo['method']), $methodInfo['parameters']);
				}
				//echo 'action after';
			} else {
				trigger404($methodInfo['class'] . ':' . $methodInfo['method'] . ' not found.');
			}
		} else {
			if ($system['debug']) {
				trigger404('file:' . $methodInfo['file'] . ' not found.');
			} else {
				trigger404();
			}
		}
	}
	public static function parseURI() {
		$pathinfo_query = self::getQueryStr();
		//echo $pathinfo_query;
		//·��hmvcģ��������Ϣ���
		$router['module'] = self::getHmvcModuleName($pathinfo_query);
		$pathinfo_query = self::checkHmvc($pathinfo_query);
		$pathinfo_query = self::checkRouter($pathinfo_query);
		//���ϵͳ����ʹ�õ�·���ַ���
		$router['query'] = $pathinfo_query;

		//print_r($router['query']);

		$system = systemInfo();
		$class_method = $system['default_controller'] . '.' . $system['default_controller_method'];
		//�����Ƿ�Ҫ�����ѯ�ַ���
		if (!empty($pathinfo_query)) {
			//��ѯ�ַ���ȥ��ͷ����/
			$pathinfo_query = ltrim($pathinfo_query, '/');
			$requests = explode("/", $pathinfo_query);
			//�����Ƿ�ָ������ͷ�����,�������еȺţ�����get��ģʽ
			preg_match('/[^&]+(?:\.[^&]+)+=?/', $requests[0]) ? $class_method = $requests[0] : null;
			if (strstr($class_method, '&') !== false) {
				$cm = explode('&', $class_method);
				$class_method = trim($cm[0], "=");
			}
		}
		//ȥ�������ĵȺţ�����У�
		$class_method = trim($class_method, "=");
		//ȥ����ѯ�ַ����е��෽�����֣�ֻ���²���
		$pathinfo_query = str_replace($class_method, '', $pathinfo_query);
		$pathinfo_query_parameters = explode("&", $pathinfo_query);
		$pathinfo_query_parameters_str = !empty($pathinfo_query_parameters[0]) ? $pathinfo_query_parameters[0] : '';
		//ȥ��������ͷ��/��ֻ���²���
		$pathinfo_query_parameters_str && $pathinfo_query_parameters_str{0} === '/' ? $pathinfo_query_parameters_str = substr($pathinfo_query_parameters_str, 1) : '';
		//�����Ѿ��������ˣ�$class_method�෽�������ַ���(main.index����$pathinfo_query_parameters_str�����ַ���(1/2)����һ������Ϊ��ʵ·��
		$origin_class_method = $class_method;
		$class_method = explode(".", $class_method);
		$method = end($class_method);
		$method = $system['controller_method_prefix'] . ($system['controller_method_ucfirst'] ? ucfirst($method) : $method);
		unset($class_method[count($class_method) - 1]);
		$file = $system['controller_folder'] . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $class_method) . $system['controller_file_subfix'];
		$class = $class_method[count($class_method) - 1];
		$parameters = explode("/", $pathinfo_query_parameters_str);
		if (count($parameters) === 1 && empty($parameters[0])) {
			$parameters = array();
		}
		//�Բ�������urldecode����һ��
		foreach ($parameters as $key => $value) {
			$parameters[$key] = urldecode($value);
		}
		$info = array('file' => $file, 'class' => ucfirst($class), 'method' => str_replace('.', '/', $method), 'parameters' => $parameters);
		#��ʼ׼��router��Ϣ
		$path = explode('.', $origin_class_method);
		$router['mpath'] = $origin_class_method;
		$router['m'] = $path[count($path) - 1];
		$router['c'] = '';
		if (count($path) > 1) {
			$router['c'] = $path[count($path) - 2];
		}
		$router['prefix'] = $system['controller_method_prefix'];
		unset($path[count($path) - 1]);
		$router['cpath'] = empty($path) ? '' : implode('.', $path);
		$router['folder'] = '';
		if (count($path) > 1) {
			unset($path[count($path) - 1]);
			$router['folder'] = implode('.', $path);
		}
		return $router + $info;
	}
	private static function getQueryStr() {
		$system = systemInfo();
		//���������м��
		if (MpInput::isCli()) {
			global $argv;
			$pathinfo_query = isset($argv[1]) ? $argv[1] : '';
		} else {
			$pathinfo = @parse_url($_SERVER['REQUEST_URI']);
//			print_r($pathinfo);
			if (empty($pathinfo)) {
				if ($system['debug']) {
					trigger404('request parse error:' . $_SERVER['REQUEST_URI']);
				} else {
					trigger404();
				}
			}
			//pathinfoģʽ����?,��ô$pathinfo['query']Ҳ�Ƿǿյģ����ʱ���ѯ�ַ�����PATH_INFO��query
			$query_str = empty($pathinfo['query']) ? '' : $pathinfo['query'];
			//print_r($query_str);
			$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '');
			//$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (isset($_SERVER['REDIRECT_PATH_INFO']) ? $_SERVER['REDIRECT_PATH_INFO'] : '');
			$pathinfo_query = empty($path_info) ? $query_str : $path_info . '&' . $query_str;
		}
		if ($pathinfo_query) {
			$pathinfo_query = trim($pathinfo_query, '/&');
		}

//add by sham

//add by sham


		//urldecode �������еĲ����������get�������������Ƶ�����
		$pq = $_pq = array();
		$_pq = explode('&', $pathinfo_query);
		foreach ($_pq as $value) {
			$p = explode('=', $value);
			if (isset($p[0])) {
				$p[0] = urldecode($p[0]);
			}
			$pq[] = implode('=', $p);
		}
		$pathinfo_query = implode('&', $pq);
		return $pathinfo_query;
	}
	private static function checkSession() {
		$system = systemInfo();
		$common_config = $system['session_handle']['common'];
		// set some important session vars
		ini_set('session.auto_start', 0);
		ini_set('session.gc_probability', 1);
		ini_set('session.gc_divisor', 100);
		ini_set('session.gc_maxlifetime', $common_config['lifetime']);
		ini_set('session.referer_check', '');
		ini_set('session.entropy_file', '/dev/urandom');
		ini_set('session.entropy_length', 16);
		ini_set('session.use_cookies', 1);
		ini_set('session.use_only_cookies', 1);
		ini_set('session.use_trans_sid', 0);
		ini_set('session.hash_function', 1);
		ini_set('session.hash_bits_per_character', 5);
		// disable client/proxy caching
		session_cache_limiter('nocache');
		// set the cookie parameters
		session_set_cookie_params(
			$common_config['lifetime'], $common_config['cookie_path'], preg_match('/^[^\\.]+$/', MpInput::server('HTTP_HOST')) ? null : $common_config['cookie_domain']
		);
		// name the session
		session_name($common_config['session_name']);
		register_shutdown_function('session_write_close');
		//session�Զ������ü��
		if (!empty($system['session_handle']['handle']) && isset($system['session_handle'][$system['session_handle']['handle']])) {
			$driver = $system['session_handle']['handle'];
			$config = $system['session_handle'];
			$handle = ucfirst($driver) . 'SessionHandle';
			if (class_exists($handle, FALSE)) {
				$session = new $handle();
				$session->start($config);
			}
		}
		// start it up
		if ($common_config['autostart']) {
			sessionStart();
		}
	}
	private static function checkRouter($pathinfo_query) {
		$system = systemInfo();
		if (is_array($system['route'])) {
			foreach ($system['route'] as $reg => $replace) {
				if (preg_match($reg, $pathinfo_query)) {
					$pathinfo_query = preg_replace($reg, $replace, $pathinfo_query);
					break;
				}
			}
		}
		return $pathinfo_query;
	}
	private static function checkHmvc($pathinfo_query) {
		if ($_module = self::getHmvcModuleName($pathinfo_query)) {
			$_system = systemInfo();
			self::switchHmvcConfig($_system['hmvc_modules'][$_module]);
			return preg_replace('|^' . $_module . '[\./&]?|', '', $pathinfo_query);
		}
		return $pathinfo_query;
	}
	private static function getHmvcModuleName($pathinfo_query) {
		$_module = current(explode('&', $pathinfo_query));
		$_module = current(explode('/', $_module));
		$_system = systemInfo();
		if (isset($_system['hmvc_modules'][$_module])) {
			return $_module;
		} else {
			return '';
		}
	}
	public static function switchHmvcConfig($hmvc_folder) {
		$_system = $system = systemInfo();
		$module = $_system['hmvc_folder'] . '/' . $hmvc_folder . '/hmvc.php';
		//$system��hmvcģ��������д
		include($module);
		//���������ã�ģ�ͣ���ͼ����⣬helper,ͬʱ�����Զ����صĶ���
		foreach (array('model_folder', 'view_folder', 'library_folder', 'helper_folder', 'helper_file_autoload', 'library_file_autoload', 'models_file_autoload') as $folder) {
			if (!is_array($_system[$folder])) {
				$_system[$folder] = array($_system[$folder]);
			}
			if (!is_array($system[$folder])) {
				$system[$folder] = array($system[$folder]);
			}
			$system[$folder] = array_merge($system[$folder], $_system[$folder]);
		}
		//�л���������
		self::setConfig($system);
	}
	public static function setConfig($system) {
		MpLoader::$system = $system;
	}
}
class MpRouter extends WoniuRouter {
	
}