<?php
/*
 * Copyright 2015 狂奔的蜗牛.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * MicroPHP
 *
 * An open source application development framework for PHP 5.2.0 or newer
 *
 * @package       MicroPHP
 * @author        狂奔的蜗牛
 * @email         672308444@163.com
 * @copyright     Copyright (c) 2013 - 2015, 狂奔的蜗牛, Inc.
 * @link          http://git.oschina.net/snail/microphp
 * @since         Version 2.3.2
 * @createdtime   2015-05-15 15:49:19
 */
 




class WoniuInput {
	public static $router;
	/**
	 * 系统最终使用的路由字符串
	 * @return type
	 */
	public static function route_query() {
		return self::$router['query'];
	}
	/**
	 * hmvc模块名称，没有模块就为空
	 * @return type
	 */
	public static function module_name() {
		return self::$router['module'];
	}
	/**
	 * url中方法的路径<br/>
	 * 比如：<br>
	 * 1.home.index<br>
	 * 2.user.home.index ，user是文件夹<br>
	 * @return type
	 */
	public static function method_path() {
		return self::$router['mpath'];
	}
	/**
	 * url中方法名称<br/>
	 * 比如：<br>
	 * 1.index<br>
	 * @return type
	 */
	public static function method_name() {
		return self::$router['m'];
	}
	/**
	 * $system配置中方法前缀,比如：do
	 * @return type
	 */
	public static function method_prefix() {
		return self::$router['prefix'];
	}
	/**
	 * url中控制器的路径<br/>
	 * 比如：<br>
	 * 1.home<br>
	 * 2.user.home ，user是文件夹<br>
	 * @return type
	 */
	public static function controller_path() {
		return self::$router['cpath'];
	}
	/**
	 * url中控制器名称<br/>
	 * 比如：<br>
	 * 1.home<br>
	 * @return type
	 */
	public static function controller_name() {
		return self::$router['c'];
	}
	/**
	 * url中文件夹名称，没有文件夹返回空<br/>
	 * 比如：<br/>
	 * 1.user
	 */
	public static function folder_name() {
		return self::$router['folder'];
	}
	/**
	 * 请求的控制器文件绝对路径<br/>
	 * 比如：/home/www/app/controllers/home.php<br/>
	 *
	 */
	public static function controller_file() {
		return self::$router['file'];
	}
	/**
	 * 请求的控制器类名称<br/>
	 * 比如：Home
	 */
	public static function class_name() {
		return self::$router['class'];
	}
	/**
	 * 请求的控制器方法名称<br/>
	 * 比如：doIndex
	 */
	public static function class_method_name() {
		return self::$router['method'];
	}
	/**
	 * 传递给控制器方法的所有参数的数组，参数为空时返回参数数组<br/>
	 * 比如：<br/>
	 * 1.home.index/username/1234，那么返回的参数数组就是：array('username','1234')<br/>
	 * 2.如果传递了$key,比如$key是1， 那么将返回1234。如果$key是2那么将返回null。<br/>
	 * @param type $key 参数的索引从0开始，如果传递了索引那么将返回索引对应的参数,不存在的索引将返回null<br/>
	 * @return null
	 */
	public static function parameters($key = null) {
		if (!is_null($key)) {
			if (isset(self::$router['parameters'][$key])) {
				return self::$router['parameters'][$key];
			} else {
				return null;
			}
		} else {
			return self::$router['parameters'];
		}
	}
	private static function get_x_type($rule, $method, $key) {
		$val = null;
		switch ($method) {
			case 'get':
				$val = self::get($key);
				break;
			case 'post':
				$val = self::post($key);
				break;
			case 'get_post':
				$val = self::get_post($key);
				break;
			case 'post_get':
				$val = self::post_get($key);
				break;
		}
		if (is_null(MpLoader::checkData($rule, array('check' => $val)))) {
			return $val;
		} else {
			return null;
		}
	}
	private static function get_rule_type($rule, $method, $key, $default = null) {
		if (!is_array($rule)) {
			$_rule = array($rule => 'err');
		} else {
			$_rule = array();
			foreach ($rule as $r) {
				$_rule[$r] = 'err';
			}
		}
		$rule = array('check' => $_rule);
		$val = self::get_x_type($rule, $method, $key);
		return is_null($val) ? $default : $val;
	}
	/**
	 * 根据验证规则和键获取一个值
	 * @param type $rule    表单验证规则.示例：1.int 2. array('int','range[1,10]')
	 * @param type $key     键
	 * @param type $default 默认值。格式错误或者验证不通过，返回默认值。
	 * @return type
	 */
	public static function get_rule($rule, $key, $default = null) {
		return self::get_rule_type($rule, 'get', $key, $default);
	}
	/**
	 * 根据验证规则和键获取一个值
	 * @param type $rule    表单验证规则.示例：1.int 2. array('int','range[1,10]')
	 * @param type $key     键
	 * @param type $default 默认值。格式错误或者验证不通过，返回默认值。
	 * @return type
	 */
	public static function post_rule($rule, $key, $default = null) {
		return self::get_rule_type($rule, 'post', $key, $default);
	}
	/**
	 * 根据验证规则和键获取一个值
	 * @param type $rule    表单验证规则.示例：1.int 2. array('int','range[1,10]')
	 * @param type $key     键
	 * @param type $default 默认值。格式错误或者验证不通过，返回默认值。
	 * @return type
	 */
	public static function get_post_rule($rule, $key, $default = null) {
		return self::get_rule_type($rule, 'get_post', $key, $default);
	}
	/**
	 * 根据验证规则和键获取一个值
	 * @param type $rule    表单验证规则.示例：1.int 2. array('int','range[1,10]')
	 * @param type $key     键
	 * @param type $default 默认值。格式错误或者验证不通过，返回默认值。
	 * @return type
	 */
	public static function post_get_rule($rule, $key, $default = null) {
		return self::get_rule_type($rule, 'post_get', $key, $default);
	}
	private static function get_int_type($method, $key, $min = null, $max = null, $default = null) {
		$val = self::get_rule_type('int', $method, $key);
		$min_okay = is_null($min) || (!is_null($min) && $val >= $min);
		$max_okay = is_null($max) || (!is_null($max) && $val <= $max);
		return $min_okay && $max_okay && !is_null($val) ? $val : $default;
	}
	/**
	 * 获取一个整数
	 * @param type $key     键
	 * @param type $min     最小值，为null不限制
	 * @param type $max     最大值，为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function get_int($key, $min = null, $max = null, $default = null) {
		return self::get_int_type('get', $key, $min, $max, $default);
	}
	/**
	 * 获取一个整数
	 * @param type $key     键
	 * @param type $min     最小值，为null不限制
	 * @param type $max     最大值，为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function post_int($key, $min = null, $max = null, $default = null) {
		return self::get_int_type('post', $key, $min, $max, $default);
	}
	/**
	 * 获取一个整数
	 * @param type $key     键
	 * @param type $min     最小值，为null不限制
	 * @param type $max     最大值，为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function get_post_int($key, $min = null, $max = null, $default = null) {
		return self::get_int_type('get_post', $key, $min, $max, $default);
	}
	/**
	 * 获取一个整数
	 * @param type $key     键
	 * @param type $min     最小值，为null不限制
	 * @param type $max     最大值，为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function post_get_int($key, $min = null, $max = null, $default = null) {
		return self::get_int_type('post_get', $key, $min, $max, $default);
	}
	private static function get_date_type($method, $key, $min = null, $max = null, $default = null) {
		$val = self::get_rule_type('date', $method, $key);
		$min_okay = is_null($min) || (!is_null($min) && strtotime($val) >= strtotime($min));
		$max_okay = is_null($max) || (!is_null($max) && strtotime($val) <= strtotime($max));
		return $min_okay && $max_okay && !is_null($val) ? $val : $default;
	}
	/**
	 * 获取日期，格式:2012-12-12
	 * @param type $key  键
	 * @param type $min  最小日期，格式:2012-12-12。为null不限制
	 * @param type $max  最大日期，格式:2012-12-12。为null不限制
	 * @param type $default 默认日期。格式错误或者不在范围，返回默认日期
	 * @return type
	 */
	public static function get_date($key, $min = null, $max = null, $default = null) {
		return self::get_date_type('get', $key, $min, $max, $default);
	}
	/**
	 * 获取日期，格式:2012-12-12
	 * @param type $key  键
	 * @param type $min  最小日期，格式:2012-12-12。为null不限制
	 * @param type $max  最大日期，格式:2012-12-12。为null不限制
	 * @param type $default 默认日期。格式错误或者不在范围，返回默认日期
	 * @return type
	 */
	public static function post_date($key, $min = null, $max = null, $default = null) {
		return self::get_date_type('post', $key, $min, $max, $default);
	}
	/**
	 * 获取日期，格式:2012-12-12
	 * @param type $key  键
	 * @param type $min  最小日期，格式:2012-12-12。为null不限制
	 * @param type $max  最大日期，格式:2012-12-12。为null不限制
	 * @param type $default 默认日期。格式错误或者不在范围，返回默认日期
	 * @return type
	 */
	public static function get_post_date($key, $min = null, $max = null, $default = null) {
		return self::get_date_type('get_post', $key, $min, $max, $default);
	}
	/**
	 * 获取日期，格式:2012-12-12
	 * @param type $key  键
	 * @param type $min  最小日期，格式:2012-12-12。为null不限制
	 * @param type $max  最大日期，格式:2012-12-12。为null不限制
	 * @param type $default 默认日期。格式错误或者不在范围，返回默认日期
	 * @return type
	 */
	public static function post_get_date($key, $min = null, $max = null, $default = null) {
		return self::get_date_type('post_get', $key, $min, $max, $default);
	}
	private static function get_time_type($method, $key, $min = null, $max = null, $default = null) {
		$val = self::get_rule_type('time', $method, $key);
		$pre_fix = '2014-01-01 ';
		$min_okay = is_null($min) || (!is_null($min) && strtotime($pre_fix . $val) >= strtotime($pre_fix . $min));
		$max_okay = is_null($max) || (!is_null($max) && strtotime($pre_fix . $val) <= strtotime($pre_fix . $max));
		return $min_okay && $max_okay && !is_null($val) ? $val : $default;
	}
	/**
	 * 获取时间，格式:15:01:55
	 * @param type $key  键
	 * @param type $min  最小时间，格式:15:01:55。为null不限制
	 * @param type $max  最大时间，格式:15:01:55。为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function get_time($key, $min = null, $max = null, $default = null) {
		return self::get_time_type('get', $key, $min, $max, $default);
	}
	/**
	 * 获取时间，格式:15:01:55
	 * @param type $key  键
	 * @param type $min  最小时间，格式:15:01:55。为null不限制
	 * @param type $max  最大时间，格式:15:01:55。为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function post_time($key, $min = null, $max = null, $default = null) {
		return self::get_time_type('post', $key, $min, $max, $default);
	}
	/**
	 * 获取时间，格式:15:01:55
	 * @param type $key  键
	 * @param type $min  最小时间，格式:15:01:55。为null不限制
	 * @param type $max  最大时间，格式:15:01:55。为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function get_post_time($key, $min = null, $max = null, $default = null) {
		return self::get_time_type('get_post', $key, $min, $max, $default);
	}
	/**
	 * 获取时间，格式:15:01:55
	 * @param type $key  键
	 * @param type $min  最小时间，格式:15:01:55。为null不限制
	 * @param type $max  最大时间，格式:15:01:55。为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function post_get_time($key, $min = null, $max = null, $default = null) {
		return self::get_time_type('post_get', $key, $min, $max, $default);
	}
	private static function get_datetime_type($method, $key, $min = null, $max = null, $default = null) {
		$val = self::get_rule_type('datetime', $method, $key);
		$min_okay = is_null($min) || (!is_null($min) && strtotime($val) >= strtotime($min));
		$max_okay = is_null($max) || (!is_null($max) && strtotime($val) <= strtotime($max));
		return $min_okay && $max_okay && !is_null($val) ? $val : $default;
	}
	/**
	 * 获取日期时间，格式:2012-12-12 15:01:55
	 * @param type $key  键
	 * @param type $min  最小日期时间，格式:2012-12-12 15:01:55。为null不限制
	 * @param type $max  最大日期时间，格式:2012-12-12 15:01:55。为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function get_datetime($key, $min = null, $max = null, $default = null) {
		return self::get_datetime_type('get', $key, $min, $max, $default);
	}
	/**
	 * 获取日期时间，格式:2012-12-12 15:01:55
	 * @param type $key  键
	 * @param type $min  最小日期时间，格式:2012-12-12 15:01:55。为null不限制
	 * @param type $max  最大日期时间，格式:2012-12-12 15:01:55。为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function post_datetime($key, $min = null, $max = null, $default = null) {
		return self::get_datetime_type('post', $key, $min, $max, $default);
	}
	/**
	 * 获取日期时间，格式:2012-12-12 15:01:55
	 * @param type $key  键
	 * @param type $min  最小日期时间，格式:2012-12-12 15:01:55。为null不限制
	 * @param type $max  最大日期时间，格式:2012-12-12 15:01:55。为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function get_post_datetime($key, $min = null, $max = null, $default = null) {
		return self::get_datetime_type('get_post', $key, $min, $max, $default);
	}
	/**
	 * 获取日期时间，格式:2012-12-12 15:01:55
	 * @param type $key  键
	 * @param type $min  最小日期时间，格式:2012-12-12 15:01:55。为null不限制
	 * @param type $max  最大日期时间，格式:2012-12-12 15:01:55。为null不限制
	 * @param type $default 默认值。格式错误或者不在范围，返回默认值
	 * @return type
	 */
	public static function post_get_datetime($key, $min = null, $max = null, $default = null) {
		return self::get_datetime_type('post_get', $key, $min, $max, $default);
	}
	public static function get_post($key = null, $default = null, $xss_clean = false) {
		$get = self::gpcs('_GET', $key,NULL);
		$val = $get === null ? self::gpcs('_POST', $key, $default) : $get;
		return $xss_clean ? self::xss_clean($val) : $val;
	}
	public static function post_get($key = null, $default = null, $xss_clean = false) {
		$get = self::gpcs('_POST', $key,NULL);
		$val = $get === null ? self::gpcs('_GET', $key, $default) : $get;
		return $xss_clean ? self::xss_clean($val) : $val;
	}
	public static function get($key = null, $default = null, $xss_clean = false) {
		$val = self::gpcs('_GET', $key, $default);
		return $xss_clean ? self::xss_clean($val) : $val;
	}
	public static function post($key = null, $default = null, $xss_clean = false) {
		$val = self::gpcs('_POST', $key, $default);
		return $xss_clean ? self::xss_clean($val) : $val;
	}
	/**
	 * 获取一个cookie
	 * 提醒:
	 * 该方法会在key前面加上系统配置里面的$system['cookie_key_prefix']
	 * 如果想不加前缀，获取原始key的cookie，可以使用方法：$this->input->cookie_raw();
	 * @param string $key      cookie键
	 * @param type $default    默认值
	 * @param type $xss_clean  xss过滤
	 * @return type
	 */
	public static function cookie($key = null, $default = null, $xss_clean = false) {
		$key = systemInfo('cookie_key_prefix') . $key;
		return self::cookieRaw($key, $default, $xss_clean);
	}
	/**
	 * 获取一个cookie
	 * @param string $key      cookie键
	 * @param type $default    默认值
	 * @param type $xss_clean  xss过滤
	 * @return type
	 */
	public static function cookieRaw($key = null, $default = null, $xss_clean = false) {
		$val = self::gpcs('_COOKIE', $key, $default);
		return $xss_clean ? self::xss_clean($val) : $val;
	}
	public static function session($key = null, $default = null) {
		return self::gpcs('_SESSION', $key, $default);
	}
	public static function server($key = null, $default = null) {
		$key = !is_null($key) ? strtoupper($key) : null;
		return self::gpcs('_SERVER', $key, $default);
	}
	private static function gpcs($range, $key, $default) {
		global $$range;
		if ($key === null) {
			return $$range;
		} else {
			$range = $$range;
			return isset($range[$key]) ? $range[$key] : ( $default !== null ? $default : null);
		}
	}
	public static function isCli() {
		return php_sapi_name() == 'cli';
	}
	public static function is_cli() {
		return self::isCli();
	}
	public static function is_ajax() {
		return (self::server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest');
	}
	public static function xss_clean($var) {
		if (is_array($var)) {
			foreach ($var as $key => $val) {
				if (is_array($val)) {
					$var[$key] = self::xss_clean($val);
				} else {
					$var[$key] = self::xss_clean0($val);
				}
			}
		} elseif (is_string($var)) {
			$var = self::xss_clean0($var);
		}
		return $var;
	}
	private static function xss_clean0($data) {
		$data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		do {
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|iframe|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		} while ($old_data !== $data);
		return $data;
	}
}

class MpInput extends WoniuInput{}
/* End of file WoniuInput.php */

class WoniuRouter {
	public static function loadClass() {
		$system = systemInfo();
		$methodInfo = self::parseURI();
		//在解析路由之后，就注册自动加载，这样控制器可以继承类库文件夹里面的自定义父控制器,实现hook功能，达到拓展控制器的功能
		//但是plugin模式下，路由器不再使用，那么这里就不会被执行，自动加载功能会失效，所以在每个instance方法里面再尝试加载一次即可，
		//如此一来就能满足两种模式
		MpLoader::classAutoloadRegister();
		if (file_exists($methodInfo['file'])) {
			include $methodInfo['file'];
			MpInput::$router = $methodInfo;
			if (!MpInput::isCli()) {
				//session自定义配置检查,只在非命令行模式下启用
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
		//路由hmvc模块名称信息检查
		$router['module'] = self::getHmvcModuleName($pathinfo_query);
		$pathinfo_query = self::checkHmvc($pathinfo_query);
		$pathinfo_query = self::checkRouter($pathinfo_query);
		//标记系统最终使用的路由字符串
		$router['query'] = $pathinfo_query;

		//print_r($router['query']);

		$system = systemInfo();
		$class_method = $system['default_controller'] . '.' . $system['default_controller_method'];
		//看看是否要处理查询字符串
		if (!empty($pathinfo_query)) {
			//查询字符串去除头部的/
			$pathinfo_query = ltrim($pathinfo_query, '/');
			$requests = explode("/", $pathinfo_query);
			//看看是否指定了类和方法名,最后可以有等号，兼容get表单模式
			preg_match('/[^&]+(?:\.[^&]+)+=?/', $requests[0]) ? $class_method = $requests[0] : null;
			if (strstr($class_method, '&') !== false) {
				$cm = explode('&', $class_method);
				$class_method = trim($cm[0], "=");
			}
		}
		//去掉最后面的等号（如果有）
		$class_method = trim($class_method, "=");
		//去掉查询字符串中的类方法部分，只留下参数
		$pathinfo_query = str_replace($class_method, '', $pathinfo_query);
		$pathinfo_query_parameters = explode("&", $pathinfo_query);
		$pathinfo_query_parameters_str = !empty($pathinfo_query_parameters[0]) ? $pathinfo_query_parameters[0] : '';
		//去掉参数开头的/，只留下参数
		$pathinfo_query_parameters_str && $pathinfo_query_parameters_str{0} === '/' ? $pathinfo_query_parameters_str = substr($pathinfo_query_parameters_str, 1) : '';
		//现在已经解析出了，$class_method类方法名称字符串(main.index），$pathinfo_query_parameters_str参数字符串(1/2)，进一步解析为真实路径
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
		//对参数进行urldecode解码一下
		foreach ($parameters as $key => $value) {
			$parameters[$key] = urldecode($value);
		}
		$info = array('file' => $file, 'class' => ucfirst($class), 'method' => str_replace('.', '/', $method), 'parameters' => $parameters);
		#开始准备router信息
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
		//命令行运行检查
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
			//pathinfo模式下有?,那么$pathinfo['query']也是非空的，这个时候查询字符串是PATH_INFO和query
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


		//urldecode 解码所有的参数名，解决get表单会编码参数名称的问题
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
		//session自定义配置检测
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
		//$system被hmvc模块配置重写
		include($module);
		//共享主配置：模型，视图，类库，helper,同时保留自动加载的东西
		foreach (array('model_folder', 'view_folder', 'library_folder', 'helper_folder', 'helper_file_autoload', 'library_file_autoload', 'models_file_autoload') as $folder) {
			if (!is_array($_system[$folder])) {
				$_system[$folder] = array($_system[$folder]);
			}
			if (!is_array($system[$folder])) {
				$system[$folder] = array($system[$folder]);
			}
			$system[$folder] = array_merge($system[$folder], $_system[$folder]);
		}
		//切换核心配置
		self::setConfig($system);
	}
	public static function setConfig($system) {
		MpLoader::$system = $system;
	}
}
class MpRouter extends WoniuRouter {
	
}
/* End of file Router.php */

class WoniuLoader {
	public $model, $lib, $router, $db, $input, $view_vars = array(), $cache, $rule;
	private static $helper_files = array(), $files = array();
	private static $instance, $config = array();
	public static $system;
	public function __construct() {
		$system = systemInfo();
		date_default_timezone_set($system['default_timezone']);
		$this->registerErrorHandle();
		$this->router = MpInput::$router;
		$this->input = new MpInput();
		$this->model = new WoniuModelLoader();
		$this->lib = new WoniuLibLoader();
		if (class_exists('MpRule', FALSE)) {
			$this->rule = new MpRule();
		}
		if (class_exists('phpFastCache', false)) {
			$this->cache = phpFastCache::getInstance($system['cache_config']['storage'], $system['cache_config']);
		}
		if ($system['autoload_db']) {
			$this->database();
		}
		stripslashes_all();
	}
	public function registerErrorHandle() {
		$system = systemInfo();
		/**
		 * 提醒：
		 * error_reporting   控制报告错误类型
		 * display_errors    控制是否在页面显示报告了的类型的错误的错误信息
		 * 言外之意就是即使报告了所有错误，但是却可以不显示错误信息。
		 * 另外：
		 * 如果用 set_error_handler() 设定了自定义的错误处理函数，
		 * 即使PHP表达式之前放置在一个@ ，但是自定义的错误处理函仍然会被调用，
		 * 当出错语句前有 @ 时, error_reporting()将返回 0。
		 * 错误处理函数可以调用 error_reporting()处理 @ 的情况。
		 */
		//只有设置了报告所有错误，handle才能捕捉所有错误

		error_reporting(E_ALL & ~E_NOTICE);
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		//是否显示错误
		if ($system['debug']) {
			ini_set('display_errors', true);
		} else {
			ini_set('display_errors', FALSE);
		}

		if ($system['error_manage'] || $system['log_error']) {
			set_exception_handler('woniu_exception_handler');
			set_error_handler('woniu_error_handler');
			register_shutdown_function('woniu_fatal_handler');
		}
	}
	public static function config($config_group, $key = null) {
		if (!is_null($key)) {
			return isset(self::$config[$config_group][$key]) ? self::$config[$config_group][$key] : null;
		} else {
			return isset(self::$config[$config_group]) ? self::$config[$config_group] : null;
		}
	}
	public function &database($config = NULL, $is_return = false, $force_new_conn = false) {
		$woniu_db = self::$system['db'];
		$db_cfg_key = $woniu_db['active_group'];
		if (is_string($config) && !empty($config)) {
			//传递配置key
			$db_cfg = $woniu_db[$config];
		} elseif (is_array($config)) {
			//传递配置
			$db_cfg = $config;
		} else {
			//没有传递配置，使用默认配置
			$db_cfg = $woniu_db[$db_cfg_key];
		}
		if ($is_return) {
			return WoniuDB::getInstance($db_cfg, $force_new_conn);
		} else {
			if ($force_new_conn || !is_object($this->db) || !is_null($config)) {
				$this->db = WoniuDB::getInstance($db_cfg, $force_new_conn);
			}
			return $this->db;
		}
	}
	public function setConfig($key, $val) {
		self::$config[$key] = $val;
	}
	public static function helper($file_name, $is_config = true) {
		$system = systemInfo();
		$helper_folders = $system['helper_folder'];
		if (!is_array($helper_folders)) {
			$helper_folders = array($helper_folders);
		}
		$count = count($helper_folders);
		foreach ($helper_folders as $k => $helper_folder) {
			$filename = $helper_folder . DIRECTORY_SEPARATOR . $file_name . $system['helper_file_subfix'];
			$filename = convertPath($filename);
			if (in_array($filename, self::$helper_files)) {
				return;
			}
			if (file_exists($filename)) {
				self::$helper_files[] = $filename;
				if ($is_config) {
					//包含文件，并把文件里面的变量放入self::config
					$before_vars = array_keys(get_defined_vars());
					$before_vars[] = 'before_vars';
				}
				include($filename);
				if ($is_config) {
					$vars = get_defined_vars();
					$all_vars = array_keys($vars);
					foreach ($all_vars as $key) {
						if (!in_array($key, $before_vars) && isset($vars[$key])) {
							self::$config[$key] = $vars[$key];
						}
					}
				}
				break;
			} else {
				if (($count - 1) == $k) {
					trigger404($filename . ' not found.');
				}
			}
		}
	}
	public static function lib($file_name, $alias_name = null, $new = true) {
		$system = systemInfo();
		$classname = $file_name;
		if (strstr($file_name, '/') !== false || strstr($file_name, "\\") !== false) {
			$classname = basename($file_name);
		}
		if (!$alias_name) {
			$alias_name = $classname;
		}
		$library_folders = $system['library_folder'];
		if (!is_array($library_folders)) {
			$library_folders = array($library_folders);
		}
		$count = count($library_folders);
		foreach ($library_folders as $key => $library_folder) {
			$filepath = $library_folder . DIRECTORY_SEPARATOR . $file_name . $system['library_file_subfix'];
			if (in_array($alias_name, array_keys(WoniuLibLoader::$lib_files))) {
				return WoniuLibLoader::$lib_files[$alias_name];
			} else {
				foreach (WoniuLibLoader::$lib_files as $aname => $obj) {
					if (strtolower(get_class($obj)) === strtolower($classname)) {
						return WoniuLibLoader::$lib_files[$alias_name] = WoniuLibLoader::$lib_files[$aname];
					}
				}
			}
			if (file_exists($filepath)) {
				self::includeOnce($filepath);
				if (class_exists($classname, FALSE)) {
					if ($new) {
						return WoniuLibLoader::$lib_files[$alias_name] = new $classname();
					} else {
						return null;
					}
				} else {
					if ($key == $count - 1) {
						trigger404('Library Class:' . $classname . ' not found.');
					}
				}
			} else {
				if ($key == $count - 1) {
					trigger404($filepath . ' not found.');
				}
			}
		}
	}
	public static function model($file_name, $alias_name = null) {
		$system = systemInfo();
		$classname = $file_name;
		if (strstr($file_name, '/') !== false || strstr($file_name, "\\") !== false) {
			$classname = basename($file_name);
		}
		if (!$alias_name) {
			$alias_name = $classname;
		}
		$model_folders = $system['model_folder'];
		if (!is_array($model_folders)) {
			$model_folders = array($model_folders);
		}
		$count = count($model_folders);
		foreach ($model_folders as $key => $model_folder) {
			//$filepath = $system['model_folder'] . DIRECTORY_SEPARATOR . $file_name . $system['model_file_subfix'];
			$filepath = $model_folder . DIRECTORY_SEPARATOR . $file_name . $system['model_file_subfix'];
			if (in_array($alias_name, array_keys(WoniuModelLoader::$model_files))) {
				return WoniuModelLoader::$model_files[$alias_name];
			} else {
				foreach (WoniuModelLoader::$model_files as &$obj) {
					if (strtolower(get_class($obj)) == strtolower($classname)) {
						return WoniuModelLoader::$model_files[$alias_name] = $obj;
					}
				}
			}
			if (file_exists($filepath)) {
				self::includeOnce($filepath);
				if (class_exists($classname, FALSE)) {
					return WoniuModelLoader::$model_files[$alias_name] = new $classname();
				} else {
					if ($key == $count - 1) {
						trigger404('Model Class:' . $classname . ' not found.');
					}
				}
			} else {
				if ($key == $count - 1) {
					trigger404($filepath . ' not  found.');
				}
			}
		}
	}
	public function view($view_name, $data = null, $return = false) {
		if (is_array($data)) {
			$this->view_vars = array_merge($this->view_vars, $data);
			extract($this->view_vars);
		} elseif (is_array($this->view_vars) && !empty($this->view_vars)) {
			extract($this->view_vars);
		}
		$system = systemInfo();
		$view_folders = $system['view_folder'];
		if (!is_array($view_folders)) {
			$view_folders = array($view_folders);
		}
		$count = count($view_folders);
		$i = 0;
		if (stripos($view_name, ':') !== false) {
			//指定了键
			$info = explode(':', $view_name);
			$path_key = current($info);
			$view_name = next($info);
			if (!isset($system['view_folder'][$path_key])) {
				trigger404('error key[' . $path_key . '] of $system["view_folder"]');
			} else {
				$dir = $system['view_folder'][$path_key];
				$view_path = $dir . DIRECTORY_SEPARATOR . $view_name . $system['view_file_subfix'];
				if (file_exists($view_path)) {
					if ($return) {
						@ob_start();
						include $view_path;
						$html = ob_get_contents();
						@ob_end_clean();
						return $html;
					} else {
						include $view_path;
						return;
					}
				} else {
					trigger404('View:' . $view_path . ' not found');
				}
			}
		} else {
			//没有指定键，遍历所有视图文件夹
			$view_path = '';
			foreach ($view_folders as $dir) {
				$view_path = $dir . DIRECTORY_SEPARATOR . $view_name . $system['view_file_subfix'];
				if (file_exists($view_path)) {
					if ($return) {
						@ob_start();
						include $view_path;
						$html = ob_get_contents();
						@ob_end_clean();
						return $html;
					} else {
						include $view_path;
						return;
					}
				} elseif (($i++) == $count - 1) {
					trigger404('View:' . $view_path . ' not found');
				}
			}
		}
	}
	public static function classAutoloadRegister() {
		$found = false;
		$__autoload_found = false;
		$auto_functions = spl_autoload_functions();
		if (is_array($auto_functions)) {
			foreach ($auto_functions as $func) {
				if (is_array($func) && $func[0] == 'MpLoader' && $func[1] == 'classAutoloader') {
					$found = TRUE;
					break;
				}
			}
			foreach ($auto_functions as $func) {
				if (!is_array($func) && $func == '__autoload') {
					$__autoload_found = TRUE;
					break;
				}
			}
		}
		if (function_exists('__autoload') && !$__autoload_found) {
			//如果存在__autoload而且没有被注册过,就显示的注册它，不然它会因为spl_autoload_register的调用而失效
			spl_autoload_register('__autoload');
		}
		if (!$found) {
			//最后注册我们的自动加载器
			spl_autoload_register(array('MpLoader', 'classAutoloader'));
		}
	}
	public static function classAutoloader($clazzName) {
		$system = systemInfo();
		$library_folders = $system['library_folder'];
		if (!is_array($library_folders)) {
			$library_folders = array($library_folders);
		}
		foreach ($library_folders as $library_folder) {
			$library = $library_folder . DIRECTORY_SEPARATOR . $clazzName . $system['library_file_subfix'];
			if (file_exists($library)) {
				self::includeOnce($library);
			} else {
				if (is_dir($library_folder)) {
					$dir = dir($library_folder);
					$found = false;
					while (($file = $dir->read()) !== false) {
						if ($file == '.' || $file == '..' || is_file($library_folder . DIRECTORY_SEPARATOR . $file)) {
							continue;
						}
						$path = truepath($library_folder) . DIRECTORY_SEPARATOR . $file . DIRECTORY_SEPARATOR . $clazzName . $system['library_file_subfix'];
						if (file_exists($path)) {
							self::includeOnce($path);
							$found = true;
							break;
						}
					}
					if ($found) {
						break;
					}
				}
			}
		}
	}
	/**
	 * 自定义Loader，用于拓展框架核心功能,
	 * Loader是控制器和模型都继承的一个类，大部分核心功能都在loader中完成。
	 * 这里是自定义Loader类文件的完整路径
	 * 自定义Loader文件名称和类名称必须是：
	 * 文件名称：类名.class.php
	 * 比如：MyLoader.class.php，文件里面的类名就是:MyLoader
	 * 注意：
	 * 1.自定义Loader必须继承MpLoader。
	 * 2.一个最简单的Loader示意：(假设文件名称是：MyLoader.class.php)
	 * class MyLoader extends MpLoader {
	 *      public function __construct() {
	 *          parent::__construct();
	 *      }
	 *  }
	 * 3.如果无需自定义Loader，留空即可。
	 */
	public static function checkUserLoader() {
		global $system;
		if (!class_exists('MpLoaderPlus', FALSE)) {
			if (!empty($system['my_loader'])) {
				self::includeOnce($system['my_loader']);
				$clazz = basename($system['my_loader'], '.class.php');
				if (class_exists($clazz, FALSE)) {
					eval('class MpLoaderPlus extends ' . $clazz . '{}');
				} else {
					eval('class MpLoaderPlus extends MpLoader{}');
				}
			} else {
				eval('class MpLoaderPlus extends MpLoader{}');
			}
		}
	}
	/**
	 * 实例化一个loader
	 * @param type $renew               是否强制重新new一个loader，默认只会new一次
	 * @param type $hmvc_module_floder  hmvc模块文件夹名称
	 * @return type MpLoader
	 */
	public static function instance($renew = null, $hmvc_module_floder = null) {
		$default = systemInfo();
		if (!empty($hmvc_module_floder)) {
			MpRouter::switchHmvcConfig($hmvc_module_floder);
		}
		//在plugin模式下，路由器不再使用，那么自动注册不会被执行，自动加载功能会失效，所以在这里再尝试加载一次，
		//如此一来就能满足两种模式
		self::classAutoloadRegister();
		//这里调用控制器instance是为了触发自动加载，从而避免了插件模式下，直接instance模型，自动加载失效的问题
		WoniuController::instance();
		$renew = is_bool($renew) && $renew === true;
		$ret = empty(self::$instance) || $renew ? self::$instance = new self() : self::$instance;
		MpRouter::setConfig($default);
		return $ret;
	}
	/**
	 * 获取视图绝对路径，在视图中include其它视图的时候用到。
	 * 提示：
	 * hvmc模式，“视图路经数组”是模块的视图数组和主配置视图数组合并后的数组。
	 * 即:$hmvc_system['view_folder']=array_merge($hmvc_system['view_folder'], $system['view_folder']);
	 * @param type $view_name 视图名称，不含后缀
	 * @param type $path_key  就是配置中“视图路经数组”的键
	 * @return string
	 */
	public static function view_path($view_name, $path_key = 0) {
		if (stripos($view_name, ':') !== false) {
			$info = explode(':', $view_name);
			$path_key = current($info);
			$view_name = next($info);
		}
		$system = systemInfo();
		if (!is_array($system['view_folder'])) {
			$system['view_folder'] = array($system['view_folder']);
		}
		if (!isset($system['view_folder'][$path_key])) {
			trigger404('error key[' . $path_key . '] of $system["view_folder"]');
		}
		$dir = $system['view_folder'][$path_key];
		$view_path = $dir . DIRECTORY_SEPARATOR . $view_name . $system['view_file_subfix'];
		return truepath($view_path);
	}
	public function ajax_echo($code, $tip = null, $data = null, $jsonp_callback = null, $is_exit = true) {
		$str = json_encode(array('code' => $code, 'tip' => is_null($tip) ? '' : $tip, 'data' => is_null($data) ? '' : $data));
		if (!empty($jsonp_callback)) {
			echo $jsonp_callback . "($str)";
		} else {
			echo $str;
		}
		if ($is_exit) {
			exit();
		}
	}
	public static function xml_echo($xml, $is_exit = true) {
		header('Content-type:text/xml;charset=utf-8');
		echo $xml;
		if ($is_exit) {
			exit();
		}
	}
	public function redirect($url, $msg = null, $time = 3, $view = null) {
		$time = intval($time) ? intval($time) : 3;
		if (empty($msg)) {
			header('Location:' . $url);
		} else {
			header("refresh:{$time};url={$url}"); //单位秒
			header("Content-type: text/html; charset=utf-8");
			if (empty($view)) {
				echo $msg;
			} else {
				$this->view($view, array('msg' => $msg, 'url' => $url, 'time' => $time));
			}
		}
		exit();
	}
	public function message($msg, $url = null, $time = 3, $view = null) {
		$time = intval($time) ? intval($time) : 3;
		if (!empty($url)) {
			header("refresh:{$time};url={$url}"); //单位秒
		}
		header("Content-type: text/html; charset=utf-8");
		$view = is_null($view) ? systemInfo('message_page_view') : $view;
		if (!empty($view)) {
			$this->view($view, array('msg' => $msg, 'url' => $url, 'time' => $time));
		} else {
			echo $msg;
		}
		exit();
	}
	public static function setCookieRaw($key, $value, $life = null, $path = '/', $domian = null, $http_only = false) {
		header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
		if (!is_null($domian)) {
			$auto_domain = $domian;
		} else {
			$host = MpInput::server('HTTP_HOST');
			// $_host = current(explode(":", $host));
			$is_ip = preg_match('/^((25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(25[0-5]|2[0-4]\d|[01]?\d\d?)$/', $host);
			$not_regular_domain = preg_match('/^[^\\.]+$/', $host);
			if ($is_ip) {
				$auto_domain = $host;
			} elseif ($not_regular_domain) {
				$auto_domain = NULL;
			} else {
				$auto_domain = '.' . $host;
			}
		}
		setcookie($key, $value, ($life ? $life + time() : null), $path, $auto_domain, (MpInput::server('SERVER_PORT') == 443 ? 1 : 0), $http_only);
		$_COOKIE[$key] = $value;
	}
	/**
	 * 设置一个cookie，该方法会在key前面加上系统配置里面的$system['cookie_key_prefix']前缀
	 * 如果不想加前缀，可以使用方法：$this->setCookieRaw()
	 */
	public static function setCookie($key, $value, $life = null, $path = '/', $domian = null, $http_only = false) {
		$key = systemInfo('cookie_key_prefix') . $key;
		return self::setCookieRaw($key, $value, $life, $path, $domian, $http_only);
	}
	/**
	 * 分页函数
	 * @param type $total 一共多少记录
	 * @param type $page  当前是第几页
	 * @param type $pagesize 每页多少
	 * @param type $url    url是什么，url里面的{page}会被替换成页码
	 * @param array $order 分页条的组成，是一个数组，可以按着1-6的序号，选择分页条组成部分和每个部分的顺序
	 * @param int $a_count   分页条中a页码链接的总数量,不包含当前页的a标签，默认10个。
	 * @return type  String
	 * echo MpLoader::instance()->page(100,3,10,'?article/list/{page}',array(3,4,5,1,2,6));
	 */
	public static function page($total, $page, $pagesize, $url, $order = array(1, 2, 3, 4, 5, 6), $a_count = 10) {
		$a_num = $a_count;
		$first = '首页';
		$last = '尾页';
		$pre = '上页';
		$next = '下页';
		$a_num = $a_num % 2 == 0 ? $a_num + 1 : $a_num;
		$pages = ceil($total / $pagesize);
		$curpage = intval($page) ? intval($page) : 1;
		$curpage = $curpage > $pages || $curpage <= 0 ? 1 : $curpage; #当前页超范围置为1
		$body = '<span class="page_body">';
		$prefix = '';
		$subfix = '';
		$start = $curpage - ($a_num - 1) / 2; #开始页
		$end = $curpage + ($a_num - 1) / 2;  #结束页
		$start = $start <= 0 ? 1 : $start;   #开始页超范围修正
		$end = $end > $pages ? $pages : $end; #结束页超范围修正
		if ($pages >= $a_num) {#总页数大于显示页数
			if ($curpage <= ($a_num - 1) / 2) {
				$end = $a_num;
			}//当前页在左半边补右边
			if ($end - $curpage <= ($a_num - 1) / 2) {
				$start-=floor($a_num / 2) - ($end - $curpage);
			}//当前页在右半边补左边
		}
		for ($i = $start; $i <= $end; $i++) {
			if ($i == $curpage) {
				$body.='<a class="page_cur_page" href="javascript:void(0);"><b>' . $i . '</b></a>';
			} else {
				$body.='<a href="' . str_replace('{page}', $i, $url) . '">' . $i . '</a>';
			}
		}
		$body.='</span>';
		$prefix = ($curpage == 1 ? '' : '<span class="page_bar_prefix"><a href="' . str_replace('{page}', 1, $url) . '">' . $first . '</a><a href="' . str_replace('{page}', $curpage - 1, $url) . '">' . $pre . '</a></span>');
		$subfix = ($curpage == $pages ? '' : '<span class="page_bar_subfix"><a href="' . str_replace('{page}', $curpage + 1, $url) . '">' . $next . '</a><a href="' . str_replace('{page}', $pages, $url) . '">' . $last . '</a></span>');
		$info = "<span class=\"page_cur\">第{$curpage}/{$pages}页</span>";
		$id="gsd09fhas9d".rand(100000, 1000000);
		$go = '<script>function ekup(){if(event.keyCode==13){clkyup();}}function clkyup(){var num=document.getElementById(\''.$id.'\').value;if(!/^\d+$/.test(num)||num<=0||num>' . $pages . '){alert(\'请输入正确页码!\');return;};location=\'' . addslashes($url) . '\'.replace(/\\{page\\}/,document.getElementById(\''.$id.'\').value);}</script><span class="page_input_num"><input onkeyup="ekup()" type="text" id="'.$id.'" style="width:40px;vertical-align:text-baseline;padding:0 2px;font-size:10px;border:1px solid gray;"/></span><span class="page_btn_go" onclick="clkyup();" style="cursor:pointer;">转到</span>';
		$total = "<span class=\"page_total\">共{$total}条</span>";
		$pagination = array(
			$total,
			$info,
			$prefix,
			$body,
			$subfix,
			$go
		);
		$output = array();
		if (is_null($order)) {
			$order = array(1, 2, 3, 4, 5, 6);
		}
		foreach ($order as $key) {
			if (isset($pagination[$key - 1])) {
				$output[] = $pagination[$key - 1];
			}
		}
		return $pages>1?implode("", $output):'';
	}
	/**
	 * $source_data和$map的key一致，$map的value是返回数据的key
	 * 根据$map的key读取$source_data中的数据，结果是以map的value为key的数数组
	 *
	 * @param Array $map 字段映射数组,格式：array('表单name名称'=>'表字段名称',...)
	 */
	public static function readData(Array $map, $source_data = null) {
		$data = array();
		$formdata = is_null($source_data) ? MpInput::post() : $source_data;
		foreach ($formdata as $form_key => $val) {
			if (isset($map[$form_key])) {
				$data[$map[$form_key]] = $val;
			}
		}
		return $data;
	}
	public static function checkData(Array $rule, Array $data = NULL, &$return_data = NULL, $db = null) {
		if (is_null($data)) {
			$data = MpInput::post();
		}
		$return_data = $data;
		/**
		 * 验证前默认值规则处理
		 */
		foreach ($rule as $col => $val) {
			//提取出默认值
			foreach ($val as $_rule => $msg) {
				if (stripos($_rule, 'default[') === 0) {
					//删除默认值规则
					unset($rule[$col][$_rule]);
					$matches = self::getCheckRuleInfo($_rule);
					$_r = $matches[1];
					$args = $matches[2];
					$return_data[$col] = isset($args[0]) ? $args[0] : '';
				}
			}
		}
		/**
		 * 验证前默认值规则处理,没有默认值就补空
		 * 并标记最后要清理的key
		 */
		$unset_keys = array();
		foreach ($rule as $col => $val) {
			if (!isset($return_data[$col])) {
				$return_data[$col] = '';
				$unset_keys[] = $col;
			}
		}
		/**
		 * 验证前set处理
		 */
		self::checkSetData('set', $rule, $return_data);
		/**
		 * 验证规则
		 */
		foreach ($rule as $col => $val) {
			foreach ($val as $_rule => $msg) {
				if (!empty($_rule)) {
					/**
					 * 可以为空规则检测
					 */
					if (empty($return_data[$col]) && isset($val['optional'])) {
						//当前字段，验证通过
						break;
					} else {
						$matches = self::getCheckRuleInfo($_rule);
						$_r = $matches[1];
						$args = $matches[2];
						if ($_r == 'set' || $_r == 'set_post' || $_r == 'optional') {
							continue;
						}
						if (!self::checkRule($_rule, $return_data[$col], $return_data, $db)) {
							/**
							 * 清理没有传递的key
							 */
							foreach ($unset_keys as $key) {
								unset($return_data[$key]);
							}
							return $msg;
						}
					}
				}
			}
		}
		/**
		 * 验证后set_post处理
		 */
		self::checkSetData('set_post', $rule, $return_data);
		/**
		 * 清理没有传递的key
		 */
		foreach ($unset_keys as $key) {
			unset($return_data[$key]);
		}
		return NULL;
	}
	private static function checkSetData($type, Array $rule, &$return_data = NULL) {
		foreach ($rule as $col => $val) {
			foreach (array_keys($val) as $_rule) {
				if (!empty($_rule)) {
					#有规则而且不是非必须的，但是没有数据，就补上空数据，然后进行验证
					if (!isset($return_data[$col])) {
						if (isset($_rule['optional'])) {
							break;
						} else {
							$return_data[$col] = '';
						}
					}
					$matches = self::getCheckRuleInfo($_rule);
					$_r = $matches[1];
					$args = $matches[2];
					if ($_r == $type) {
						$_v = $return_data[$col];
						$_args = array($_v, $return_data);
						foreach ($args as $func) {
							if (function_exists($func)) {
								$reflection = new ReflectionFunction($func);
								//如果是系统函数
								if ($reflection->isInternal()) {
									$_args = array($_v);
								}
							}
							$_v = self::callFunc($func, $_args);
						}
						$return_data[$col] = $_v;
					}
				}
			}
		}
	}
	private static function getCheckRuleInfo($_rule) {
		$matches = array();
		preg_match('|([^\[]+)(?:\[(.*)\](.?))?|', $_rule, $matches);
		$matches[1] = isset($matches[1]) ? $matches[1] : '';
		$matches[3] = !empty($matches[3]) ? $matches[3] : ',';
		if ($matches[1] != 'reg') {
			$matches[2] = isset($matches[2]) ? explode($matches[3], $matches[2]) : array();
		} else {
			$matches[2] = isset($matches[2]) ? array($matches[2]) : array();
		}
		return $matches;
	}
	/**
	 * 调用一个方法或者函数(无论方法是静态还是动态，是私有还是保护还是公有的都可以调用)
	 * 所有示例：
	 * 1.调用类的静态方法
	 * $ret=$this->callFunc('UserModel::encodePassword', $args);
	 * 2.调用类的方法
	 * $ret=$this->callFunc(array('UserModel','checkPassword), $args);
	 * 3.调用用户自定义方法
	 * $ret=$this->callFunc('cleanJs', $args);
	 * 4.调用系统函数
	 * $ret=$this->callFunc('var_dump', $args);
	 * @param type $func
	 * @param type $args
	 * @return boolean
	 */
	public static function callFunc($func, $args) {
		if (is_array($func)) {
			return self::callMethod($func, $args);
		} elseif (function_exists($func)) {
			return call_user_func_array($func, $args);
		} elseif (stripos($func, '::')) {
			$_func = explode('::', $func);
			return self::callMethod($_func, $args);
		}
		return null;
	}
	private static function callMethod($_func, $args) {
		$class = $_func[0];
		$method = $_func[1];
		if (is_object($class)) {
			$class = new ReflectionClass(get_class($class));
		} else {
			$class = new ReflectionClass($class);
		}
		$obj = $class->newInstanceArgs();
		$method = $class->getMethod($method);
		$method->setAccessible(true);
		return $method->invokeArgs($obj, $args);
	}
	private static function checkRule($_rule, $val, $data, $db = null) {
		if (!$db) {
			$db = MpLoader::instance()->database();
		}
		$matches = self::getCheckRuleInfo($_rule);
		$_rule = $matches[1];
		$args = $matches[2];
		switch ($_rule) {
			case 'required':
				return !empty($val);
			case 'match':
				return isset($args[0]) && isset($data[$args[0]]) ? $val && ($val == $data[$args[0]]) : false;
			case 'equal':
				return isset($args[0]) ? $val && ($val == $args[0]) : false;
			case 'enum':
				return in_array($val, $args);
			case 'unique':#比如unique[user.name] , unique[user.name,id:1]
				if (!$val || !count($args)) {
					return false;
				}
				$_info = explode('.', $args[0]);
				if (count($_info) != 2) {
					return false;
				}
				$table = $_info[0];
				$col = $_info[1];
				if (isset($args[1])) {
					$_id_info = explode(':', $args[1]);
					if (count($_id_info) != 2) {
						return false;
					}
					$id_col = $_id_info[0];
					$id = $_id_info[1];
					$id = stripos($id, '#') === 0 ? MpInput::get_post(substr($id, 1)) : $id;
					$where = array($col => $val, "$id_col <>" => $id);
				} else {
					$where = array($col => $val);
				}
				return !$db->where($where)->from($table)->count_all_results();
			case 'exists':#比如exists[user.name] , exists[user.name,type:1], exists[user.name,type:1,sex:#sex]
				if (!$val || !count($args)) {
					return false;
				}
				$_info = explode('.', $args[0]);
				if (count($_info) != 2) {
					return false;
				}
				$table = $_info[0];
				$col = $_info[1];
				$where = array($col => $val);
				if (count($args) > 1) {
					foreach (array_slice($args, 1) as $v) {
						$_id_info = explode(':', $v);
						if (count($_id_info) != 2) {
							continue;
						}
						$id_col = $_id_info[0];
						$id = $_id_info[1];
						$id = stripos($id, '#') === 0 ? MpInput::get_post(substr($id, 1)) : $id;
						$where[$id_col] = $id;
					}
				}
				return $db->where($where)->from($table)->count_all_results();
			case 'min_len':
				return isset($args[0]) ? (mb_strlen($val, 'UTF-8') >= intval($args[0])) : false;
			case 'max_len':
				return isset($args[0]) ? (mb_strlen($val, 'UTF-8') <= intval($args[0])) : false;
			case 'range_len':
				return count($args) == 2 ? (mb_strlen($val, 'UTF-8') >= intval($args[0])) && (mb_strlen($val, 'UTF-8') <= intval($args[1])) : false;
			case 'len':
				return isset($args[0]) ? (mb_strlen($val, 'UTF-8') == intval($args[0])) : false;
			case 'min':
				return isset($args[0]) && is_numeric($val) ? $val >= $args[0] : false;
			case 'max':
				return isset($args[0]) && is_numeric($val) ? $val <= $args[0] : false;
			case 'range':
				return (count($args) == 2) && is_numeric($val) ? $val >= $args[0] && $val <= $args[1] : false;
			case 'alpha':#纯字母
				return !preg_match('/[^A-Za-z]+/', $val);
			case 'alpha_num':#纯字母和数字
				return !preg_match('/[^A-Za-z0-9]+/', $val);
			case 'alpha_dash':#纯字母和数字和下划线和-
				return !preg_match('/[^A-Za-z0-9_-]+/', $val);
			case 'alpha_start':#以字母开头
				return preg_match('/^[A-Za-z]+/', $val);
			case 'num':#纯数字
				return !preg_match('/[^0-9]+/', $val);
			case 'int':#整数
				return preg_match('/^([-+]?[1-9]\d*|0)$/', $val);
			case 'float':#小数
				return preg_match('/^([1-9]\d*|0)\.\d+$/', $val);
			case 'numeric':#数字-1，1.2，+3，4e5
				return is_numeric($val);
			case 'natural':#自然数0，1，2，3，12，333
				return preg_match('/^([1-9]\d*|0)$/', $val);
			case 'natural_no_zero':#自然数不包含0
				return preg_match('/^[1-9]\d*$/', $val);
			case 'email':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $val) : $args[0];
			case 'url':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^http[s]?:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/', $val) : $args[0];
			case 'qq':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^[1-9][0-9]{4,}$/', $val) : $args[0];
			case 'phone':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^(?:\d{3}-?\d{8}|\d{4}-?\d{7})$/', $val) : $args[0];
			case 'mobile':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(14[0-9]{1}))+\d{8})$/', $val) : $args[0];
			case 'zipcode':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^[1-9]\d{5}(?!\d)$/', $val) : $args[0];
			case 'idcard':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^\d{14}(\d{4}|(\d{3}[xX])|\d{1})$/', $val) : $args[0];
			case 'ip':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^((25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(25[0-5]|2[0-4]\d|[01]?\d\d?)$/', $val) : $args[0];
			case 'chs':
				$count = implode(',', array_slice($args, 1, 2));
				$count = empty($count) ? '1,' : $count;
				$can_empty = isset($args[0]) && $args[0] == 'true';
				return !empty($val) ? preg_match('/^[\x{4e00}-\x{9fa5}]{' . $count . '}$/u', $val) : $can_empty;
			case 'date':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$/', $val) : $args[0];
			case 'time':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^(([0-1][0-9])|([2][0-3])):([0-5][0-9])(:([0-5][0-9]))$/', $val) : $args[0];
			case 'datetime':
				$args[0] = isset($args[0]) && $args[0] == 'true' ? TRUE : false;
				return !empty($val) ? preg_match('/^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30))) (([0-1][0-9])|([2][0-3])):([0-5][0-9])(:([0-5][0-9]))$/', $val) : $args[0];
			case 'reg':#正则表达式验证,reg[/^[\]]$/i]
				/**
				 * 模式修正符说明:
				  i	表示在和模式进行匹配进不区分大小写
				  m	将模式视为多行，使用^和$表示任何一行都可以以正则表达式开始或结束
				  s	如果没有使用这个模式修正符号，元字符中的"."默认不能表示换行符号,将字符串视为单行
				  x	表示模式中的空白忽略不计
				  e	正则表达式必须使用在preg_replace替换字符串的函数中时才可以使用(讲这个函数时再说)
				  A	以模式字符串开头，相当于元字符^
				  Z	以模式字符串结尾，相当于元字符$
				  U	正则表达式的特点：就是比较“贪婪”，使用该模式修正符可以取消贪婪模式
				 */
				return !empty($args[0]) ? preg_match($args[0], $val) : false;
			/**
			 * set set_post不参与验证，返回true跳过
			 *
			 * 说明：
			 * set用于设置在验证数据前对数据进行处理的函数或者方法
			 * set_post用于设置在验证数据后对数据进行处理的函数或者方法
			 * 如果设置了set，数据在验证的时候验证的是处理过的数据
			 * 如果设置了set_post，可以通过第三个参数$data接收数据：$this->checkData($rule, $_POST, $data)，$data是验证通过并经过set_post处理后的数据
			 * set和set_post后面是一个或者多个函数或者方法，多个逗号分割
			 * 注意：
			 * 1.无论是函数或者方法都必须有一个字符串返回
			 * 2.如果是系统函数，系统会传递当前值给系统函数，因此系统函数必须是至少接受一个字符串参数，比如md5，trim
			 * 3.如果是自定义的函数，系统会传递当前值和全部数据给自定义的函数，因此自定义函数可以接收两个参数第一个是值，第二个是全部数据$data
			 * 4.如果是类的方法写法是：类名称::方法名 （方法静态动态都可以，public，private，都可以）
			 */
			case 'set':
			case 'set_post':
				return true;
			default:
				$_args = array_merge(array($val, $data), $args);
				$matches = self::getCheckRuleInfo($_rule);
				$func = $matches[1];
				$args = $matches[2];
				if (function_exists($func)) {
					$reflection = new ReflectionFunction($func);
					//如果是系统函数
					if ($reflection->isInternal()) {
						$_args = isset($_args[0]) ? array($_args[0]) : array();
					}
				}
				return self::callFunc($_rule, $_args);
		}
		return false;
	}
	public static function includeOnce($file_path) {
		$key = md5(truepath(convertPath($file_path)));
		if (!isset(self::$files[$key])) {
			include $file_path;
			self::$files[$key] = 1;
		}
	}
}
class MpLoader extends WoniuLoader{}

MpLoader::checkUserLoader();
class WoniuModelLoader {
	public static $model_files = array();
	function __get($classname) {
		if (isset(self::$model_files[$classname])) {
			return self::$model_files[$classname];
		} else {
			return MpLoader::model($classname);
		}
	}
}
class WoniuLibLoader {
	public static $lib_files = array();
	function __get($classname) {
		if (isset(self::$lib_files[$classname])) {
			return self::$lib_files[$classname];
		} else {
			return MpLoader::lib($classname);
		}
	}
}
/* End of file Loader.php */








class WoniuModel extends MpLoaderPlus {
	private static $instance;
	/**
	 * 实例化一个模型
	 * @param type $classname_path
	 * @param type $hmvc_module_floder
	 * @return type WoniuModel
	 */
	public static function instance($classname_path = null, $hmvc_module_floder = NULL) {
	if (!empty($hmvc_module_floder)) {
	    MpRouter::switchHmvcConfig($hmvc_module_floder);
	}
	//这里调用控制器instance是为了触发自动加载，从而避免了插件模式下，直接instance模型，自动加载失效的问题
	WoniuController::instance();
	if (empty($classname_path)) {
	    $renew = is_bool($classname_path) && $classname_path === true;
	    MpLoader::classAutoloadRegister();
	    return empty(self::$instance) || $renew ? self::$instance = new self() : self::$instance;
	}
	$system = systemInfo();
	$classname_path = str_replace('.', DIRECTORY_SEPARATOR, $classname_path);
	$classname = basename($classname_path);
	$model_folders = $system['model_folder'];
	if (!is_array($model_folders)) {
	    $model_folders = array($model_folders);
	}
	$count = count($model_folders);
	//在plugin模式下，路由器不再使用，那么自动注册不会被执行，自动加载功能会失效，所以在这里再尝试加载一次，
	//如此一来就能满足两种模式
	MpLoader::classAutoloadRegister();
	foreach ($model_folders as $key => $model_folder) {
	    $filepath = $model_folder . DIRECTORY_SEPARATOR . $classname_path . $system['model_file_subfix'];
	    $alias_name = $classname;
	    if (in_array($alias_name, array_keys(WoniuModelLoader::$model_files))) {
		return WoniuModelLoader::$model_files[$alias_name];
	    }
	    if (file_exists($filepath)) {
		if (!class_exists($classname, FALSE)) {
		    MpLoader::includeOnce($filepath);
		}
		if (class_exists($classname, FALSE)) {
		    return WoniuModelLoader::$model_files[$alias_name] = new $classname();
		} else {
		    if ($key == $count - 1) {
			trigger404('Model Class:' . $classname . ' not found.');
		    }
		}
	    } else {
		if ($key == $count - 1) {
		    trigger404($filepath . ' not  found.');
		}
	    }
	}
	}
}
class MpModel extends WoniuModel {
}
/**
 * Description of WoniuTableModel
 *
 * @author pm
 */
class MpTableModel extends MpModel {
	/**
	 * 表主键名称
	 * @var string
	 */
	public $pk;
	/**
	 * 表的字段名称数组
	 * @var array
	 */
	public $keys = array();
	/**
	 * 不含表前缀的表名称
	 * @var string
	 */
	public $table;
	/**
	 * 含表前缀的表名称
	 * @var string
	 */
	public $full_table;
	/**
	 * 字段映射，$key是表单name名称，$val是字段名
	 * @var array
	 */
	public $map = array();
	/**
	 * 当前$this->db使用的表前缀
	 * @var string
	 */
	public $prefix;
	/**
	 * 完整的表字段信息
	 * @var array
	 */
	public $fields = array();
	private static $models = array(), $table_cache = array();
	/**
	 * 初始化一个表模型，返回模型实例
	 * @param type $table         名称
	 * @param CI_DB_active_record $db 数据库连接对象
	 * @return MpTableModel
	 */
	public function init($table, $db = null) {
	if (is_null($this->db)) {
	    $this->database();
	}
	if (!is_null($db)) {
	    $this->db = $db;
	}
	$this->prefix = $this->db->dbprefix;
	$this->table = $table;
	$this->full_table = $this->prefix . $table;
	$this->fields = $fields = $this->getTableFieldsInfo($table, $this->db);
	foreach ($fields as $col => $info) {
	    if ($info['primary']) {
		$this->pk = $col;
	    }
	    $this->keys[] = $col;
	    $this->map[$col] = $col;
	}
	return $this;
	}
	/**
	 * 实例化一个默认表模型
	 * @param type $table
	 * @return MpTableModel
	 */
	public static function M($table, $db = null) {
	if (!isset(self::$models[$table])) {
	    self::$models[$table] = new MpTableModel();
	    self::$models[$table]->init($table, $db);
	}
	return self::$models[$table];
	}
	/**
	 * 表所有字段数组
	 * @return array
	 */
	public function columns() {
	return $this->keys;
	}
	/**
	 * 缓存表字段信息，并返回
	 * @staticvar array $info  字段信息数组
	 * @param type $tableName  不含前缀的表名称
	 * @return array
	 */
	public static function getTableFieldsInfo($tableName, $db) {
	if (!empty(self::$table_cache[$tableName])) {
	    return self::$table_cache[$tableName];
	}
	if (!file_exists($cache_file = systemInfo('table_cache_folder') . DIRECTORY_SEPARATOR . $tableName . '.php')) {
	    $info = array();
	    $result = $db->query('SHOW FULL COLUMNS FROM ' . $db->dbprefix . $tableName)->result_array();
	    if ($result) {
		foreach ($result as $val) {
		    $info[$val['Field']] = array(
			'name' => $val['Field'],
			'type' => $val['Type'],
			'comment' => $val['Comment'] ? $val['Comment'] : $val['Field'],
			'notnull' => $val['Null'] == 'NO' ? 1 : 0,
			'default' => $val['Default'],
			'primary' => (strtolower($val['Key']) == 'pri'),
			'autoinc' => (strtolower($val['Extra']) == 'auto_increment'),
		    );
		}
	    }
	    $content = 'return ' . var_export($info, true) . ";\n";
	    $content = '<?' . 'php' . "\n" . $content;
	    file_put_contents($cache_file, $content);
	    $ret_info[$tableName] = $info;
	} else {
	    $ret_info[$tableName] = include ($cache_file);
	}
	return $ret_info[$tableName];
	}
	/**
	 * 数据验证
	 * @param type $source_data 数据源，要检查的数据
	 * @param type $ret_data    数据验证通过$ret_data是验证规则处理后的数据用户插入或者更新到数据库,数据验证失败$ret_data是空数组
	 * @param type $rule 验证规则<br/>
	 *                   格式：array(<br/>
	 *                               '字段名称'=>array(<br/>
	 *                                               '表单验证规则'=>'验证失败提示信息'<br/>
	 *                                               ,...   <br/>
	 *                                               )<br/>
	 *                               ,...<br/>
	 *                             )<br/>
	 * @param type $map  字段映射信息数组。格式：array('表单name名称'=>'表字段名称',...)
	 * @return string 返回null:验证通过。非空字符串:验证失败提示信息。
	 */
	public function check($source_data, &$ret_data, $rule = null, $map = null) {
	$rule = !is_array($rule) ? array() : $rule;
	$map = is_null($map) ? $this->map : $map;
	$data = $this->readData($map, $source_data);
	return $this->checkData($rule, $data, $ret_data);
	}
	/**
	 * 添加数据
	 * @param array $ret_data  需要添加的数据
	 * @return boolean
	 */
	public function insert($ret_data) {
	return $this->db->insert($this->table, $ret_data);
	}
	/**
	 * 更新数据
	 * @param type $ret_data  需要更新的数据
	 * @param type $where     可以是where条件关联数组，还可以是主键值。
	 * @return boolean
	 */
	public function update($ret_data, $where) {
	$where = is_array($where) ? $where : array($this->pk => $where);
	return $this->db->where($where)->update($this->table, $ret_data);
	}
	/**
	 * 获取一条或者多条数据
	 * @param type $values      可以是一个主键的值或者主键的值数组，还可以是where条件
	 * @param boolean $is_rows  返回多行记录还是单行记录，true：多行，false：单行
	 * @param type $order_by    当返回多行记录时，可以指定排序，比如：'time desc'
	 * @return int
	 */
	public function find($values, $is_rows = false, $order_by = null) {
	if (empty($values)) {
	    return 0;
	}
	if (is_array($values)) {
	    $is_asso = array_diff_assoc(array_keys($values), range(0, sizeof($values))) ? TRUE : FALSE;
	    if ($is_asso) {
		$this->db->where($values);
	    } else {
		$is_rows = true;
		$this->db->where_in($this->pk, array_values($values));
	    }
	} else {
	    $this->db->where(array($this->pk => $values));
	}
	if ($order_by) {
	    $this->db->order_by($order_by);
	}
	if (!$is_rows) {
	    $this->db->limit(1);
	}
	$rs = $this->db->get($this->table);
	if ($is_rows) {
	    return $rs->result_array();
	} else {
	    return $rs->row_array();
	}
	}
	/**
	 * 获取所有数据
	 * @param type $where   where条件数组
	 * @param type $orderby 排序，比如: id desc
	 * @param type $limit   limit数量，比如：10
	 * @param type $fileds  要搜索的字段，比如：id,name。留空默认*
	 * @return type
	 */
	public function findAll($where = null, $orderby = NULL, $limit = null, $fileds = null) {
	if (!is_null($fileds)) {
	    $this->db->select($fileds);
	}
	if (!is_null($where)) {
	    $this->db->where($where);
	}
	if (!is_null($orderby)) {
	    $this->db->order_by($orderby);
	}
	if (!is_null($limit)) {
	    $this->db->limit($limit);
	}
	return $this->db->get($this->table)->result_array();
	}
	/**
	 * 根据条件获取一个字段的值或者数组
	 * @param type $col         字段名称
	 * @param type $where       可以是一个主键的值或者主键的值数组，还可以是where条件
	 * @param boolean $is_rows  返回多行记录还是单行记录，true：多行，false：单行
	 * @param type $order_by    当返回多行记录时，可以指定排序，比如：'time desc'
	 * @return type
	 */
	public function findCol($col, $where, $is_rows = false, $order_by = null) {
	$row = $this->find($where, $is_rows, $order_by);
	if (!$is_rows) {
	    return isset($row[$col]) ? $row[$col] : null;
	} else {
	    $vals = array();
	    foreach ($row as $v) {
		$vals[] = $v[$col];
	    }
	    return $vals;
	}
	}
	/**
	 *
	 * 根据条件删除记录
	 * @param type $values 可以是一个主键的值或者主键主键的值数组
	 * @param type $cond   附加的where条件，关联数组
	 * 成功则返回影响的行数，失败返回false
	 */
	public function delete($values, Array $cond = NULL) {
	return $this->deleteIn($this->pk, $values, $cond);
	}
	/**
	 *
	 * 根据条件删除记录
	 * @param type $key    where in的字段名称
	 * @param type $values 可以是一个主键的值或者主键主键的值数组
	 * @param type $cond   附加的where条件，关联数组
	 * 成功则返回影响的行数，失败返回false
	 * @return int|boolean
	 */
	public function deleteIn($key, $values, Array $cond = NULL) {
	if (empty($values)) {
	    return 0;
	}
	if (is_array($values)) {
	    $this->db->where_in($key, array_values($values));
	} else {
	    $this->db->where(array($key => $values));
	}
	if (!empty($cond)) {
	    $this->db->where($cond);
	}
	if ($this->db->delete($this->table)) {
	    return $this->db->affected_rows();
	} else {
	    return false;
	}
	}
	/**
	 * 分页方法
	 * @param int $page       第几页
	 * @param int $pagesize   每页多少条
	 * @param string $url     基础url，里面的{page}会被替换为实际的页码
	 * @param string $fields  select的字段，全部用*，多个字段用逗号分隔
	 * @param array $where    where条件，关联数组
	 * @param array $like     搜素的字段，比如array('title'=>'java');搜索title包含java
	 * @param string $orderby 排序字段，比如: 'id desc'
	 * @param array $page_bar_order   分页条组成，可以参考手册分页条部分
	 * @param int   $page_bar_a_count 分页条a的数量，可以参考手册分页条部分
	 * @return type
	 */
	public function getPage($page, $pagesize, $url, $fields = '*', Array $where = null, Array $like = null, $orderby = null, $page_bar_order = array(1, 2, 3, 4, 5, 6), $page_bar_a_count = 10) {
	$data = array();
	if (is_array($where)) {
	    $this->db->where($where);
	}
	if (is_array($like)) {
	    $this->db->like($like);
	}
	$total = $this->db->from($this->table)->count_all_results();
	//这里必须重新附加条件，上面的count会重置条件
	if (is_array($where)) {
	    $this->db->where($where);
	}
	if (is_array($like)) {
	    $this->db->like($like);
	}
	if (!is_null($orderby)) {
	    $this->db->order_by($orderby);
	}
	$data['items'] = $this->db->select($fields)->limit($pagesize, ($page - 1) * $pagesize)->get($this->table)->result_array();
	$data['page'] = $this->page($total, $page, $pagesize, $url, $page_bar_order, $page_bar_a_count);
	return $data;
	}
	/**
	 * SQL搜索
	 * @param type $page      第几页
	 * @param type $pagesize  每页多少条
	 * @param type $url       基础url，里面的{page}会被替换为实际的页码
	 * @param type $fields    select的字段，全部用*，多个字段用逗号分隔
	 * @param type $cond      SQL语句where后面的部分，不要带limit
	 * @param array $page_bar_order   分页条组成，可以参考手册分页条部分
	 * @param int   $page_bar_a_count 分页条a的数量，可以参考手册分页条部分
	 * @return type
	 */
	public function search($page, $pagesize, $url, $fields, $cond, $page_bar_order = array(1, 2, 3, 4, 5, 6), $page_bar_a_count = 10) {
	$data = array();
	$table = $this->full_table;
	$query = $this->db->query('select count(*) as total from ' . $table . (strpos(trim($cond), 'order') === 0 ? '' : ' where') . $cond)->row_array();
	$total = $query['total'];
	$data['items'] = $this->db->query('select ' . $fields . ' from ' . $table . (strpos(trim($cond), 'order') === 0 ? '' : ' where') . $cond . ' limit ' . (($page - 1) * $pagesize) . ',' . $pagesize)->result_array();
	$data['page'] = $this->page($total, $page, $pagesize, $url, $page_bar_order, $page_bar_a_count);
	return $data;
	}
}
/* End of file Model.php */


/**
 * 表单规则助手类，再不用记忆规则名称
 */
class WoniuRule {
	/**
	 * 规则说明：<br/>
	 * 如果元素为空，则返回FALSE<br/><br/><br/>
	 */
	public static function required() {
		return 'required';
	}
	/**
	 * 规则说明：<br/>
	 * 当没有post对应字段的值或者值为空的时候那么就会使用默认规则的值作为该字段的值。<br/>
	 * 然后用这个值继续 后面的规则进行验证。<br/>
	 * @param string $val 默认值<br/><br/><br/>
	 */
	public static function defaultVal($val = '') {
		return 'default[' . $val . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 可以为空规则。例如user字段规则中有optional,当没有传递字段user的值或者值是空的时候，<br/>
	 * user验证会通过(忽略其它规则即使有required规则)， <br/>
	 * 提示： <br/>
	 * $this->checkData($rule, $_POST, $ret_data)返回的数据$ret_data， <br/>
	 * 如果传递了user字段$ret_data就有user字段，反之没有user字段. <br/>
	 * 如果user传递有值，那么就会用这个值继续后面的规则进行验证。<br/><br/><br/>
	 */
	public static function optional() {
		return 'optional';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素的值与参数中对应的表单字段的值不相等，则返回FALSE<br/>
	 * @param string $field_name 表单字段名称<br/><br/><br/>
	 */
	public static function match($field_name) {
		return 'match[' . $field_name . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素的值不与指定的值相等，则返回FALSE<br/>
	 * @param string $val 指定的值<br/><br/><br/>
	 */
	public static function equal($val) {
		return 'equal[' . $val . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不在指定的几个值中，则返回FALSE<br/>
	 * @param string $val 规则内容,多个值用逗号分割，或者用第个参数指定的分割符<br/>
	 * @param string $delimiter 规则内容的分割符，比如：# ，默认为空即可<br/><br/><br/>
	 */
	public static function enum($val, $delimiter = '') {
		return 'enum[' . $val . ']' . $delimiter;
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素的值与指定数据表栏位有重复，则返回False<br/>
	 * 比如unique[user.email]，那么验证类会去查找user表中email字段有没有与表单元素一样的值，<br/>
	 * 如存重复，则返回false，这样开发者就不必另写callback验证代码。<br/>
	 * 如果指定了id:1,那么除了id为1之外的记录的email字段不能与表单元素一样，<br/>
	 * 如果一样返回false<br/>
	 * @param string $val 规则内容，比如：1、table.field 2、table.field,id:1<br/>
	 * @param string $delimiter 规则内容的分割符，比如：# ，默认为空即可<br/><br/><br/>
	 */
	public static function unique($val, $delimiter = '') {
		return 'unique[' . $val . ']' . $delimiter;
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素的值在指定数据表的字段中不存在则返回false，如果存在返回true<br/>
	 * 比如exists[cat.cid]，那么验证类会去查找cat表中cid字段有没有与表单元素一样的值<br/>
	 * cat.cid后面还可以指定附加的where条件<br/>
	 * 比如：exists[users.uname,user_id:2,...] 可以多个条件，逗号分割。<br/>
	 * 上面的规测生成的where就是array('uname'=>$value,'user_id'=>2,....)<br/>
	 * @param string $val 规则内容，比如：1、table.field 2、table.field,id:1<br/>
	 * @param string $delimiter 规则内容的分割符，比如：# ，默认为空即可<br/><br/><br/>
	 */
	public static function exists($val, $delimiter = '') {
		return 'exists[' . $val . ']' . $delimiter;
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值的字符长度小于参数定义的值，则返回FALSE<br/>
	 * @param int $val 长度数值<br/><br/><br/>
	 */
	public static function min_len($val) {
		return 'min_len[' . $val . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值的字符长度小于参数定义的值，则返回FALSE<br/>
	 * @param int $val 长度数值<br/><br/><br/>
	 */
	public static function max_len($val) {
		return 'min_len[' . $val . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值的字符长度不在指定的范围，则返回FALSE<br/>
	 * @param int $min_len 最小长度数值<br/>
	 * @param int $max_len 最大长度数值<br/><br/><br/>
	 */
	public static function range_len($min_len, $max_len) {
		return 'range_len[' . $min_len . ',' . $max_len . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值的字符长度不是指定的长度，则返回FALSE<br/>
	 * @param int $val 长度数值<br/><br/><br/>
	 */
	public static function len($val) {
		return 'len[' . $val . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是数字或者小于指定的值，则返回FALSE<br/>
	 * @param int $val 数值<br/><br/><br/>
	 */
	public static function min($val) {
		return 'min[' . $val . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是数字或者大于指定的值，则返回FALSE<br/>
	 * @param int $val 数值<br/><br/><br/>
	 */
	public static function max($val) {
		return 'max[' . $val . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是数字或者大小不在指定的范围内，则返回 FALSE<br/>
	 * @param int $min 最小数值<br/>
	 * @param int $max 最大数值<br/><br/><br/>
	 */
	public static function range($min, $max) {
		return 'range[' . $min . ',' . $max . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素中包含除字母以外的字符，则返回FALSE<br/><br/><br/>
	 */
	public static function alpha() {
		return 'alpha';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素中包含除字母和数字以外的字符，则返回FALSE<br/><br/><br/>
	 */
	public static function alpha_num() {
		return 'alpha_num';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值中包含除字母/数字/下划线/破折号以外的其他字符，则返回FALSE<br/><br/><br/>
	 */
	public static function alpha_dash() {
		return 'alpha_dash';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素中不是字母开头，则返回FALSE<br/><br/><br/>
	 */
	public static function alpha_start() {
		return 'alpha_start';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素中不是纯数字，则返回FALSE<br/><br/><br/>
	 */
	public static function num() {
		return 'num';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素中不是整数，则返回FALSE<br/><br/><br/>
	 */
	public static function int() {
		return 'int';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素中不是小数，则返回FALSE<br/><br/><br/>
	 */
	public static function float() {
		return 'float';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素中不是一个数，则返回FALSE<br/><br/><br/>
	 */
	public static function numeric() {
		return 'numeric';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值中包含了非自然数的其他数值 （其他数值不包括零），则返回FALSE。<br/><br/><br/>
	 * 自然数形如：0,1,2,3....等等。
	 */
	public static function natural() {
		return 'natural';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值包含了非自然数的其他数值 （其他数值包括零），则返回FALSE。<br/><br/><br/>
	 * 非零的自然数：1,2,3.....等等。
	 */
	public static function natural_no_zero() {
		return 'natural_no_zero';
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是一个网址，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function url($can_empty = false) {
		return self::can_empty_rule('url', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值包含不合法的email地址，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function email($can_empty = false) {
		return self::can_empty_rule('email', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是一个QQ号，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function qq($can_empty = false) {
		return self::can_empty_rule('qq', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是一个电话号码，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function phone($can_empty = false) {
		return self::can_empty_rule('phone', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是一个手机号，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function mobile($can_empty = false) {
		return self::can_empty_rule('mobile', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是一个邮政编码，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function zipcode($can_empty = false) {
		return self::can_empty_rule('zipcode', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是一个身份证号，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function idcard($can_empty = false) {
		return self::can_empty_rule('idcard', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是一个合法的IPv4地址，则返回FALSE。<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function ip($can_empty = false) {
		return self::can_empty_rule('ip', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是汉字，或者不是指定的长度，则返回FALSE<br/>
	 * 规则示例：<br/>
	 * 1.规则内容：false    描述：必须是汉字，不能为空<br/>
	 * 2.规则内容：true     描述：必须是汉字，可以为空<br/>
	 * 3.规则内容：false,2  描述：必须是2个汉字，不能为空<br/>
	 * 4.规则内容：true,2   描述：必须是2个汉字，可以为空<br/>
	 * 5.规则内容：true,2,3 描述：必须是2-3个汉字，可以为空<br/>
	 * 6.规则内容：false,2, 描述：必须是2个以上汉字，不能为空<br/>
	 * @param boolean $val 规则内容。默认为空，即规则：必须是汉字不能为空<br/>
	 * @param string $delimiter 规则内容的分割符，比如：# ，默认为空即可<br/><br/><br/>
	 */
	public static function chs($val = '', $delimiter = '') {
		return 'chs' . ($val ? '[' . $val . ']' . $delimiter : '');
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是正确的日期格式YYYY-MM-DD，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function date($can_empty = false) {
		return self::can_empty_rule('date', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是正确的日期时间格式YYYY-MM-DD HH:MM:SS，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function datetime($can_empty = false) {
		return self::can_empty_rule('datetime', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不是正确的时间格式HH:MM:SS，则返回FALSE<br/>
	 * @param boolean $can_empty 是否允许为空。true:允许 false:不允许。默认：false<br/><br/><br/>
	 */
	public static function time($can_empty = false) {
		return self::can_empty_rule('time', $can_empty);
	}
	/**
	 * 规则说明：<br/>
	 * 如果表单元素值不匹配指定的正则表达式，则返回FALSE<br/>
	 * @param string $val 正则表达式。比如：1./^[]]$/ 2./^A$/i<br/>
	 * 模式修正符说明:<br/>
	 * i 表示在和模式进行匹配进不区分大小写<br/>
	 * m 将模式视为多行，使用^和$表示任何一行都可以以正则表达式开始或结束<br/>
	 * s 如果没有使用这个模式修正符号，元字符中的"."默认不能表示换行符号,将字符串视为单行<br/>
	 * x 表示模式中的空白忽略不计<br/>
	 * e 正则表达式必须使用在preg_replace替换字符串的函数中时才可以使用(讲这个函数时再说)<br/>
	 * A 以模式字符串开头，相当于元字符^<br/>
	 * Z 以模式字符串结尾，相当于元字符$<br/>
	 * U 正则表达式的特点：就是比较“贪婪”，使用该模式修正符可以取消贪婪模式<br/><br/><br/>
	 */
	public static function reg($val) {
		return 'reg[' . $val . ']';
	}
	/**
	 * 规则说明：<br/>
	 * 数据在验证之前处理数据的规则，数据在验证的时候验证的是处理过的数据<br/>
	 * 注意：<br/>
	 * set和set_post后面是一个或者多个函数或者方法，多个逗号分割<br/>
	 * 1.无论是函数或者方法都必须有一个字符串返回<br/>
	 * 2.如果是系统函数，系统会传递当前值给系统函数，因此系统函数必须是至少接受一个字符串参数<br/>
	 * 3.如果是自定义的函数，系统会传递当前值和全部数据给自定义的函数，因此自定义函数可以接收两个参数第一个是值，第二个是全部数据$data<br/>
	 * 4.如果是类的方法写法是：类名称::方法名 （方法静态动态都可以，public，private，都可以）<br/>
	 * @param string $val 规则内容。比如：trim<br/>
	 * @param string $delimiter 规则内容的分割符，比如：# ，默认为空即可<br/><br/><br/>
	 */
	public static function set($val, $delimiter = '') {
		return 'set[' . $val . ']' . $delimiter;
	}
	/**
	 * 规则说明：<br/>
	 * 数据在验证通过之后处理数据的规则，$this->checkData()第三个变量接收的就是set和set_post处理过的数据<br/>
	 * 注意：<br/>
	 * set和set_post后面是一个或者多个函数或者方法，多个逗号分割<br/>
	 * 1.无论是函数或者方法都必须有一个字符串返回<br/>
	 * 2.如果是系统函数，系统会传递当前值给系统函数，因此系统函数必须是至少接受一个字符串参数<br/>
	 * 3.如果是自定义的函数，系统会传递当前值和全部数据给自定义的函数，因此自定义函数可以接收两个参数第一个是值，第二个是全部数据$data<br/>
	 * 4.如果是类的方法写法是：类名称::方法名 （方法静态动态都可以，public，private，都可以）<br/>
	 * @param string $val 规则内容。比如：sha1,md5<br/>
	 * @param string $delimiter 规则内容的分割符，比如：# ，默认为空即可<br/><br/><br/>
	 */
	public static function set_post($val, $delimiter = '') {
		return 'set_post[' . $val . ']' . $delimiter;
	}
	private static function can_empty_rule($rule_name, $can_empty) {
		return $rule_name . ($can_empty ? '[true]' : '');
	}
}
class MpRule extends WoniuRule{}

class MP{
}
/* End of file Helper.php */

