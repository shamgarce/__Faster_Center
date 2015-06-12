<?php
/*
********************************************
* 插件机制核心API
* author  :同城陌路人
* email  :kikicn.cn@qq.com
* last modify :2008-11-30
********************************************
*/

//*****************************插件机制核心API*****************************【
$Tag_filters=array();
$Tag_actions=array();

$filters_to_remove=array();
$actions_to_remove=array();


function do_filter($tag){
    global $Tag_filters,$filters_to_remove;
    $args=func_get_args();
    if(empty($Tag_filters[$tag])) return $args[1];
    if(sizeof($Tag_filters[$tag])>1){
        foreach($Tag_filters[$tag] as $k => $v){
            $priority[$k]=$v['priority'];
        }
        array_multisort($priority,SORT_ASC,array_keys($priority),SORT_ASC,$Tag_filters[$tag]);
    }
    if(isset($filters_to_remove[$tag])){
        foreach ($filters_to_remove[$tag] as $fun){
            remove_action($tag,$fun);
        }
    }
    foreach($Tag_filters[$tag] as $the_){
        $args[1]=call_user_func_array($the_['fun'],array_slice($args,1,$the_['accept_arg_num']));
    }
    return $args[1];
}

function add_filter($tag,$fun_to_add,$accept_arg_num=1,$priority=10){
    global $Tag_filters;
    if ($accept_arg_num<1) $accept_arg_num=1;
    $Tag_filters[$tag][]=array('fun'=>$fun_to_add,'accept_arg_num'=>$accept_arg_num,'priority'=>$priority);
}

//执行到挂载点$tag时移除挂载点$tag下的所有名为$fun_to_remove的函数
function add_remove_filter($tag,$fun_to_remove){
    global $filters_to_remove;
    if (in_array($fun_to_remove,(array)$filters_to_remove[$tag])) return ;
    $filters_to_remove[$tag][]=$fun_to_remove;
}

//立即移除在此之前绑定在挂载点$tag下的所有名为$fun_to_remove的函数
function remove_filter($tag,$fun_to_remove){
    global $Tag_filters;
    if(!isset($Tag_filters[$tag])) return ;
    foreach ($Tag_filters[$tag] as $k=>$v){
        if($v['fun']==$fun_to_remove){
            unset($Tag_filters[$tag][$k]);
        }
    }
}

//*****************************action部分
function do_action($tag){
    global $Tag_actions,$actions_to_remove;
    $args=func_get_args();
    if(empty($Tag_actions[$tag])) return $args[1];
    if(sizeof($Tag_actions[$tag])>1){
        foreach($Tag_actions[$tag] as $k => $v){
            $priority[$k]=$v['priority'];
        }
        array_multisort($priority,SORT_ASC,array_keys($priority),SORT_ASC,$Tag_actions[$tag]);
    }

    if(isset($actions_to_remove[$tag])){
        foreach ($actions_to_remove[$tag] as $fun){
            remove_action($tag,$fun);
        }
    }
    foreach($Tag_actions[$tag] as $the_){
        call_user_func_array($the_['fun'],array_slice($args,1,$the_['accept_arg_num']));
    }
}

function add_action($tag,$fun_to_add,$accept_arg_num=0,$priority=10){
    global $Tag_actions;
    $Tag_actions[$tag][]=array('fun'=>$fun_to_add,'accept_arg_num'=>$accept_arg_num,'priority'=>$priority);
}

//执行到挂载点$tag时移除挂载点$tag下的所有名为$fun_to_remove的函数
function add_remove_action($tag,$fun_to_remove){
    global $actions_to_remove;
        if(in_array($fun_to_remove,(array)$actions_to_remove[$tag])) return ;
    $actions_to_remove[$tag][]=$fun_to_remove;
}

//立即移除在此之前绑定在挂载点$tag下的所有名为$fun_to_remove的函数
function remove_action($tag,$fun_to_remove){
    global $Tag_actions;
    if(!isset($Tag_actions[$tag])) return ;
    foreach ($Tag_actions[$tag] as $k=>$v){
        if($v['fun']==$fun_to_remove){
            unset($Tag_actions[$tag][$k]);
        }
    }
}
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】
//*****************************插件机制核心API*****************************】







$filter =array();
function add_action($key,$value,$order=10) {
    global $filter;
    $filter[$key][$order]=$value;
}

function do_action($key) {
    global $filter;
    ksort($filter[$key]);
    foreach ($filter[$key] as $function) {
        call_user_func($function);
    }
}

function action1() {
    echo "1111";
    echo "<hr />";
}
function action2() {
    echo "2222";
    echo "<hr />";
}
function action3() {
    echo "3333";
    echo "<hr />";
}

add_action('header', 'action1', 7);
add_action('header', 'action3');
add_action('header', 'action2', 5);
do_action('header');





















