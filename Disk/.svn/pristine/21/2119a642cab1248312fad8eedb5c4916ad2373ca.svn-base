<?php
/**
 * 应用内标记
 */
define('IN_WONIU_APP', TRUE);

/**
 * 调试工具条
 */
define('DEBUGBAR', true);


/**
 * 环境，生产环境？开发环境？
 * 这里不是最好，还需要斟酌
 */
define('ENVIRONMENT', 'testing');
if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL && ~E_NOTICE);
			break;
		case 'testing':
			error_reporting(E_ALL);
			break;
		case 'production':
			error_reporting(0);
			break;
		default:
			exit('The application environment is not set correctly.');
	}
}


include('F/Base/Base.php');
include('F/Base/Error.php');
include('F/Base/Env.php');
////加载主运行文件
include('F/F.php');

F::run();		//入口方法


//$env = Env::getInstance();






//var_dump($env);

//$env = new Env();
//$env->run();
//$env->count();

//echo 1;

//F::run();		//运行

/**
 * --------------------------------------------------------------
 *
 *
 *
 *
 *
 * --------------------------------------------------------------
流程
 * 加载配置文件
 * 获取到路由字段
 * 运行controllers
 ****** 依赖注入
 ****** view
 ****** input
 ****** model
 ****** lib
 ****** cache
 ****** db
 ****** table
 *
 * 更底层依赖 供上面所有的对象调用
 * Fbase对象 [不稳定，多变，需要经常整理 被上层对象调用，还要更好利用下层数据和对象]
 *
 *
 * Environment	//提供原始数据，和稳定变量，稳定方法
 */




