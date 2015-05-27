<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	$loginForm=D('LoginForm');
    	if(IS_POST){
	    	$loginForm->attributes=$_POST;
	    	if($loginForm->validate()){
	    		//验证成功处理数据
	    		echo 'success';
	    	}
    	}
    	$this->assign('loginForm',$loginForm);
    	$this->assign('errors',$loginForm->getErrors());
    	$this->display();
    }
}