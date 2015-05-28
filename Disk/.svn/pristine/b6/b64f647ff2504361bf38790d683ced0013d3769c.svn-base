<form name="artadduser" action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input name="uname" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="pwd" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
					uname 		: $("input[name='uname']").val(),
					pwd 	: $("input[name='pwd']").val(),
					},
				dataType: "json",
				async:false,
				cache:false
			}).responseJSON
			return res;
		},
		cancel:function(){},						//点击cancel按钮
		close:function(){},							//关闭对话框 不是回调
	}

</script>
