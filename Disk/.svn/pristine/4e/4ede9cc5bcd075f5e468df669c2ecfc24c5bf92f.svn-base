<?php

	define('IN_WONIU_APP', TRUE);
	define('WDS', DIRECTORY_SEPARATOR);
	//Sham Seter
	define('SALT', 'ccab8f440ff0825e');

	include('Seter/Seter.php');

	//\Seter\Seter::sterini();
	/* End of file index.php */
	include('MicroPHP.Config.php');				//会生成一个$System的变量存放配置文件	//改成一个新的类文件来专门处理config
	include('MicroPHP.Fun.Pre.php');			//新的函数重写
	include('MicroPHP.Fun.php');				//函数库

	//include('MicroPHP.Db.Class.php');
	//include('MicroPHP.Session.Class.php');
	//include('MicroPHP.Fastercache.Class.php');

	include('MicroPHP.Router.php');				//路由对象，并且入口在这里			//需要更改入口
	include('MicroPHP.Input.php');
	include('MicroPHP.Loader.php');
	//include('MicroPHP.Formrule.php');
	include('MicroPHP.Controller.php');
	include('MicroPHP.Model.php');
	include('MicroPHP.Fast.php');


	/**
	 * 注册HMVC模块，这里填写模块名称关联数组,键是url中的模块别名，值是模块文件夹名称
	 */
	$system['hmvc_modules'] = array(
		'demo' 	=> 'hmvc_demo',
		'manage' => 'hmvc_manage',
		'man' 	=> 'hmvc_man',
		'v6' 	=> 'hmvc_v6',
		'doc' 	=> 'hmvc_doc',
		'u' 	=> 'hmvc_u',
		'login' => 'hmvc_login',
	);
	$system['debug'] = true;



/**
 * 是否开启调试模式
 * true：显示错误信息,
 * false：所有错误将不显示
 */
//$mp = WoniuRouter::parseURI();
//print_r($mp);
MpRouter::setConfig($system);
MpRouter::loadClass();
