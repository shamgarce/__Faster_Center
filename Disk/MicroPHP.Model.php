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

class MP{
}
/* End of file Helper.php */

