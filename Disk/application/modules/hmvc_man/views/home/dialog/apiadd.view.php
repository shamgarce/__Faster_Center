<table class="table table-hover table-condensed" >
    <tr>
        <td valign="top"><table class="table table-hover table-condensed" >
                <tr>
                    <td>接口映射</td>
                </tr>
                <tr>
                  <td>排序 ： 
                  <input name="sort" type="text" value="9" /></td>
                </tr>
                <tr>
                    <td>版本 :
                        <input name="v" type="text" value="v6" /></td>
                </tr>
                <tr>
                    <td>接口 :<input type="text" name="api" />
                        </td>
                </tr>
                <tr>
                    <td>名称 :
                        <input name="name" type="text" size="50" /></td>
                </tr>
                <tr>
                    <td>映射 :
                        <input name="ys" type="text" value="r/s" />
                        后台填写</td>
                </tr>
                <tr>
                    <td>调试 :
                        <input name="debug" type="radio" value="0" />
                        关闭
                        <input name="debug" type="radio" value="1" checked="checked"/>
                        开启</td>
                </tr>
                <tr>
                  <td>关闭 :
                    <input name="enable" type="radio" value="1" checked="checked"/>
有效
<input type="radio" name="enable" value="0"/>
无效</td>
                </tr>
                <tr>
                    <td>类型 ： 
                      <br />
                      <input name="type" type="radio" value="GET" checked="checked"/> 
                      GET
<br />
<input type="radio" name="type" value="POST"/> 
POST
<br />
<input type="radio" name="type" value="PUT"/> 
PUT
<br />
<input type="radio" name="type" value="DELETE"/> 
DELETE
<br />
<input type="radio" name="type" value="OTHER"/> 
OTHER</td>
                </tr>
            </table></td>
        <td><table class="table table-hover table-condensed" >
                <tr>
                    <td>模拟提交<br />
                      <textarea class="request" name="request" cols="60" rows="6"></textarea></td>
                </tr>
                <tr>
                    <td>模拟回复<br />
                      <textarea class="response" name="response" cols="60" rows="6"></textarea></td>
                </tr>
                <tr>
                    <td>说明<br />
          <textarea class="dis" name="dis" cols="60" rows="6">模块 :
说明 :
参数 :
成功 :
失败 :</textarea></td>
                </tr>
            </table></td>
    </tr>
</table>
<script type="text/dialog">

this.opt = {				//确定按钮的点击
	ok:function(){
			var res = $.ajax({
			url : '/man/home.apiadd',
			type: 'post',
			data: {
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