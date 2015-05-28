<?php
/*
 * 两种情况
 * 1  控制器存在
 * 2  控制器不存在
 * */
    $mp = WoniuRouter::parseURI();              //获得路由信息
    $mpath  = \Sham::saddslashes($mp['mpath']);
    //$mpath  = 'user/changepassword';
    $row    = \Seter\Seter::getInstance()->table->f_userapi->where(" api = '$mpath'")->getrow();
    $result = $row['response'];
    if(empty($result))$result = "{\"code\":200,\"msg\":\"ok: wait for design \",\"data\":\"\"}";
echo $result;
exit;

?>
