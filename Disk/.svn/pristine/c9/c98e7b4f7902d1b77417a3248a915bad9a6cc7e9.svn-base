<form name="artadduser" action="" method="post">
  <div class="form-group">
    <label for="exampleInputPassword1">分类名</label>
    <input name="dgroupname" type="text" class="form-control" id="groupname" placeholder="groupname" value="<?php echo $row['groupname'];?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">标识</label>
    <input name="dgroupchr" type="text" class="form-control" id="chr" placeholder="标识" value="<?php echo $row['groupchr'];?>">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">排　序</label>
    <input name="dsort" type="text" class="form-control" id="sort" placeholder="sort" value="<?php echo $row['sort'];?>">
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">是否有效</label> ： 
    <input name="denable" type="radio" id="optionsRadios3" value="1" <?php if($row['enable'] == 1){?>checked="CHECKED"<?php }?>> 有效
    <input type="radio" name="denable" id="optionsRadios3" value="0" <?php if($row['enable'] != 1){?>checked="CHECKED"<?php }?>> 无效 
  </div>
	<input name="dgroupid" type="hidden" value="<?php echo $row['groupid'];?>">
</form>

<script type="text/dialog">
ob = this;
	//ok按钮动作
	this.opt = {				//确定按钮的点击
		ok:function(){
			var res = $.ajax({
				url : '/manage/home.groupedit',
				type: 'post',
				data: {
						groupid 	: $("input[name='dgroupid']").val(),
						groupname 	: $("input[name='dgroupname']").val(),
						groupchr 	: $("input[name='dgroupchr']").val(),
						sort 		: $("input[name='dsort']").val(),
						enable 	: $("input[name='denable']:checked").val(),
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
