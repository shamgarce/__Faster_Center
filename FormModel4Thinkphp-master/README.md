FormModel4Thinkphp
==================

根据`yii`的表单模型和验证器代码简单修改而来，因为是从yii中修改来的，所以使用方法和`yii`的几乎一样，只是去掉了几个验证规则，具体示例可以看demo项目

`不喜轻喷,测试不足，可能会有bug，欢迎反馈`

###使用###

将FormModel.class.php放到框架目录ThinkPHP/Extend/Model，然后就可以使用此model了。

###创建模型###

1.定义模型



	class LoginFormModel extends FormModel{

	}



2.声明验证规则



	public function rules()
	{
		return array(
				array('username,password,address', 'required'),
				array('username','length','min'=>6,'max'=>20),
				array('password','length','min'=>6,'max'=>20),
				array('email','email','message'=>'格式不正确'),
				array('website','url'),
				array('username','checkUserNameExist'),//自定义方法
		);
	}
	//验证规则格式，具体可以看各验证器类中的属性，
	array('要验证的名称', '验证器', '验证器属性'=>'验证器属性值', ...)
	


3.设置验证名称对应的中文标签、



	public function attributeLabels(){
		return array(
			'username'=>'用户名',
			'password'=>'密码',
			'address'=>'地址',
			'email'=>'邮箱',
			'website'=>'网址'
		);
	}


###在控制器中使用###


		$loginForm=D('LoginForm');
    	if(IS_POST){
	    	$loginForm->attributes=$_POST;
	    	if($loginForm->validate()){
	    		//验证成功处理数据
	    		echo 'success';
	    	}
    	}
		//如果用ajax ，这里可以就直接传过去错误就可以了
    	$this->assign('loginForm',$loginForm);
    	$this->assign('errors',$loginForm->getErrors());
    	$this->display();



###在视图中###



	<form method="post">
			<li><span class="label">用户名</span><input type="text" name="username" value="{$loginForm->username}"/><span class="error">{$errors.username}</span></li>
			<li><span class="label">密码</span><input type="password" name="password"  value="{$loginForm->password}"/><span class="error">{$errors.password}</span></li>
			<li><span class="label">地址</span><input type="text" name="address"  value="{$loginForm->address}"/><span class="error">{$errors.address}</span></li>
			<li><span class="label">邮箱</span><input type="text" name="email"  value="{$loginForm->email}"/><span class="error">{$errors.email}</span></li>
			<li><span class="label">网址</span><input type="text" name="website"  value="{$loginForm->website}"/><span class="error">{$errors.website}</span></li>
			<li><span></span><input type="submit" value="提交"/></li>
		</ul>
		</form>



