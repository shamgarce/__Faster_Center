<form name="artadduser" action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>

</form>

<script type="text/dialog">
ob = this;
	//ok按钮动作
	this.opt = {				//确定按钮的点击
		ok:function(){
			var res = $.ajax({
				url : '/manage/home.useradd',
				type: 'post',
				data: {
					email 		: $("input[name='email']").val(),
					password 	: $("input[name='password']").val(),
					},
				dataType: "json",
				async:false,
				cache:false
			});
			console.log(res);
			return res;
		},
		cancel:function(){},						//点击cancel按钮
		close:function(){},							//关闭对话框 不是回调
	}

</script>
