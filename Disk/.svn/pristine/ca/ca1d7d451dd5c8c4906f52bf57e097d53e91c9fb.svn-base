<table class="table table-hover table-condensed" >
    <tr>
        <td valign="top"><table class="table table-hover table-condensed" >
                <tr>
                    <td>接口映射</td>
                </tr>
                <tr>
                  <td>排序 ： 
                  <input name="sort" type="text" value="<?php echo $row['sort'];?>" />
                  
                  <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                  </td>
                </tr>
                <tr>
                    <td>版本 :
                        <input name="v" type="text" value="<?php echo $row['v'];?>" /></td>
                </tr>
                <tr>
                    <td>接口 : <input type="text" name="api"  value="<?php echo $row['api'];?>" />
                        </td>
                </tr>
                <tr>
                    <td>名称 :
                       <input name="name" type="text" size="50"  value="<?php echo $row['name'];?>" /></td>
                </tr>
                <tr>
                    <td>映射 :
                        <input name="ys" type="text" value="<?php echo $row['ys'];?>" />
                        后台填写</td>
                </tr>
                <tr>
                    <td>调试 :
                        <input name="debug" type="radio" value="0" <?php if($row['debug']!=1){?>checked="checked"<?php }?>/>
                        关闭
                        <input name="debug" type="radio" value="1" <?php if($row['debug']==1){?>checked="checked"<?php }?>/>
                        开启</td>
                </tr>
                <tr>
                  <td>关闭 :
                    <input name="enable" type="radio" value="1" <?php if($row['enable']==1){?>checked="checked"<?php }?>/>
有效
<input type="radio" name="enable" value="0" <?php if($row['enable']!=1){?>checked="checked"<?php }?>/>
无效</td>
                </tr>
                <tr>
                    <td>类型 ： 
                      <br />
                      <input name="type" type="radio" value="GET"  <?php if($row['type']=='GET'){?>checked="checked"<?php }?>/> 
                      GET
<br />
<input type="radio" name="type" value="POST" <?php if($row['type']=='POST'){?>checked="POST"<?php }?>/> 
POST
<br />
<input type="radio" name="type" value="PUT" <?php if($row['type']=='PUT'){?>checked="PUT"<?php }?>/> 
PUT
<br />
<input type="radio" name="type" value="DELETE" <?php if($row['type']=='DELETE'){?>checked="DELETE"<?php }?>/> 
DELETE
<br />
<input type="radio" name="type" value="OTHER" <?php if($row['type']=='OTHER'){?>checked="OTHER"<?php }?>/> 
OTHER</td>
                </tr>
            </table></td>
        <td><table class="table table-hover table-condensed" >
                <tr>
                    <td>模拟提交<br />
                      <textarea class="request" name="request" cols="60" rows="6"><?php echo $row['request'];?></textarea></td>
                </tr>
                <tr>
                    <td>模拟回复<br />
                      <textarea class="response" name="response" cols="60" rows="6"><?php echo $row['response'];?></textarea></td>
                </tr>
                <tr>
                    <td>说明<br />
          <textarea class="dis" name="dis" cols="60" rows="6"><?php echo $row['dis'];?></textarea></td>
                </tr>
            </table></td>
    </tr>
</table>
<script type="text/dialog">

this.opt = {				//确定按钮的点击
	ok:function(){
			var res = $.ajax({
			url : '/man/home.apiedit',
			type: 'post',
			data: {
				id 	: $("input[name='id']").val(),
				name 	: $("input[name='name']").val(),
				v 		: $("input[name='v']").val(),
				api 	: $("input[name='api']").val(),
				ys 		: $("input[name='ys']").val(),

				dis 	: $(".dis").val(),
				request : $(".request").val(),
				response: $(".response").val(),
				sort 	: $("input[name='sort']").val(),
				
				
				type 	: $("input[name='type']:checked").val(),
				debug 	: $("input[name='debug']:checked").val(),
				enable 	: $("input[name='enable']:checked").val(),
				},
			dataType: "json",
			async:false,
			cache:false
		}).responseJSON;
		//console.log(res);
		//==========================1
		if(res.code<0){
			alert(res.msg);
			return false;
		}else{
			//location.reload();
			return true;
		}
		return true;
	},
	cancel:function(){},						//点击cancel按钮
	close:function(){},							//关闭对话框 不是回调
}

</script>