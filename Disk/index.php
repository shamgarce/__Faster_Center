<?php

define('IN_WONIU_APP', TRUE);
define('WDS', DIRECTORY_SEPARATOR);
//Sham Seter
define('SALT', 'ERTYUIOP[567890-');

include('Seter/Seter.php');

//\Seter\Seter::sterini();
/* End of file index.php */
include('MicroPHP.Config.php');
include('MicroPHP.Fun.php');
//include('MicroPHP.Db.Class.php');
//include('MicroPHP.Session.Class.php');
//include('MicroPHP.Fastercache.Class.php');
include('MicroPHP.php');
include('MicroPHP.Controller.php');


/**
 * 注册HMVC模块，这里填写模块名称关联数组,键是url中的模块别名，值是模块文件夹名称
 */
$system['hmvc_modules'] = array(
	'demo' => 'hmvc_demo',
	'manage' => 'hmvc_manage',
	'man' => 'hmvc_man',
	'v6' => 'hmvc_v6',
);
$system['debug'] = false;



/**
 * 是否开启调试模式
 * true：显示错误信息,
 * false：所有错误将不显示
 */
MpRouter::setConfig($system);
MpRouter::loadClass();
