<form name="artadduser" action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">用户名</label>
    <input name="" type="email" class="form-control" placeholder="<?php echo $user['uname']?>" disabled="disabled" value="<?php echo $user['uname']?>">
    <input name="uname" type="hidden" value="<?php echo $user['uname']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">真实姓名</label>
    <input name="tname" type="text" class="form-control" placeholder="真实姓名" value="<?php echo $user['tname']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">用户组</label>
    <select name="groupid" class="form-control groupid">
		<?php
		 foreach($groupysid2name as $key=>$value){
        ?>
        <option value=<?php echo $key;?> <?php if($user['groupid'] == $key){?>selected="selected"<?php }?>><?php echo $value;?></option>
		<?php 
        }
        ?>
    </select>
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">密码</label>
    <input name="pwd" type="password" class="form-control" placeholder="密码" value="">
  </div>

</form>

<script type="text/dialog">
ob = this;
	//ok按钮动作
	this.opt = {				//确定按钮的点击
		ok:function(){
			var res = $.ajax({
				url : '/manage/home.useredit',
				type: 'post',
				data: {
					uname 	: $("input[name='uname']").val(),
					tname 	: $("input[name='tname']").val(),
					groupid : $(".groupid").val(),
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
