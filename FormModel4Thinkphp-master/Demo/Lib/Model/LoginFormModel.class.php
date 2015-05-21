<?php
class LoginFormModel extends FormModel{

	public function rules()
	{
		return array(
				array('username,password,address', 'required'),
				array('username','length','min'=>6,'max'=>20),
				array('password','length','min'=>6,'max'=>20),
				array('email','email','message'=>'格式不正确'),
				array('website','url'),
				array('username','checkUserNameExist'),//这里用自定义方法
		);
	}
	
	public function attributeLabels(){
		return array(
			'username'=>'用户名',
			'password'=>'密码',
			'address'=>'地址',
			'email'=>'邮箱',
			'website'=>'网址'
		);
	}
	//这是自定义方法
	function checkUserNameExist($attribute,$params){
		//从数据库查询
		if($result){
			$this->addError($attribute, '用户名已经存在了');
		}
	}
	
}