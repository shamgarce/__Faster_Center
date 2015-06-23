<?php


define('IN_WONIU_APP', TRUE);
define('WDS', DIRECTORY_SEPARATOR);
//Sham Seter
define('SALT', 'ccab8f440ff0825e');


/**
 * 拟框架
 */
include('Seter/I.php');			//入口代码
$s = new \Seter\Seter();
//echo $s->sys->pathinfo_query.'<br>';
//$s->sys->pathinfo_query = 'asdf/afsd/asdf/asdf/index.php?r=s123.asdf.afd';

$ms = $s->config->get();
exit;
$ms = $s->router->urianal('asdf/afsd/asdf/asdf/index.php?&m=123.asdf.a&&1=123.asdf.a&&m=123.asdf.a&&m=123.asdf.a&c=234&&&&&&&fd');
print_r($ms);
//$s->router->test();
echo 'mark';

//$m = $s->sys->pathinfo_query.'___';
//echo $m;

exit;
//include('plugin.php');
//
////
////(1).$db=MpLoader::instance()->database(null,true);
//////实例化一个welcome控制器，然后调用其doIndex方法
////(2).MpController::instance('welcome')->doIndex();
//////实例化控制器目录里admin文件夹下面的login控制器，然后调用其doIndex方法
////MpController::instance('admin.login')->doIndex();//admin是文件夹
//////实例化一个User模型，然后调用其add方法
////(3).MpModel::instance('User')->add('snail');
//
//
////不走路由
//MpController::instance('home','hmvc_man')->doIndex();
//
////MpController::instance('home','hmvc_man')->doIndex();
//
////doc_document_obsidian

//echo intval($_GET['page']);
//$page = empty($_GET['page'])?1:intval($_GET['page']);
