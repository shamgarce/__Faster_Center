<?php include($this->view_path('common/manageheader',1));?>


  <body>

  <?php include($this->view_path('common/managenavtop',1));?>


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include($this->view_path('common/managenavleft',1));?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo $title ?></h1>
          登陆界面
          <a class="btn btn-primary useradd">添加用户</a>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th width="50">&nbsp;</th>
                  <th>用户名</th>
                  <th>真实姓名</th>
                  <th>groupid</th>
                  <th>密码</th>
                  <th>登陆时间</th>
                  <th>登陆ip</th>
                  <th width="100">有效?</th>
                  <th width="100">操作</th>
                </tr>
              </thead>
              <tbody>
<?php
foreach($userlist as $key=>$value)
{
?>
                <tr>
                  <td><?php echo $value['uid']?></td>
                  <td><?php echo $value['uname']?></td>
                  <td><?php echo $value['tname']?></td>
                  <td><?php echo $value['groupid']?></td>
                  <td>********</td>
                  <td><?php echo $value['logtime']?></td>
                  <td><?php echo $value['logip']?></td>
                  <td>
<?php
if($value['enable']){
?>
<a class="action_cflag" rel="1" uname="<?php echo $value['uname']?>" href="javascript:void(0)">
<span class=" glyphicon glyphicon-ok green"></span>
</a>
<?php }else{?>
<a class="action_cflag" rel="0" uname="<?php echo $value['uname']?>" href="javascript:void(0)">
<span class=" glyphicon glyphicon-remove red"></span>
</a>                  
<?php
}
?>                  
                  
                  </td>
                  <td> <a rel="<?php echo $value['uid']?>" class="btn btn-danger btn-sm useredit">修改</a></td>
                </tr>
<?php
}
?>                
                
                
                <tr>
                  <td colspan="9">&nbsp;</td>
                </tr>
              </tbody>
            </table>
           <hr>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/A/Jquery/jquery-1.11.1.min.js"></script>
    <script src="/A/bootstrap-3.3.4/js/bootstrap.min.js"></script>
  <script src="/A/artDialog4.1.7/artDialog.js?skin=default"></script>
  <script src="/A/CK.js"></script>    
    
    <!-- script src="assets/js/docs.min.js"></script -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script language="javascript">
$(document).ready(function(){
	$('.useradd').click(function(){
		$.CK({
			ok:true,
			title:'添加用户',
			rel: '/manage/home.useradd',
			callback:function(){
				location.reload() ;
			}
		});
	})
	
	$('.useredit').click(function(){
		$.CK({
			ok:true,
			title:'添加用户',
			rel: '/manage/home.useredit/'+ $(this).attr('rel'),
			callback:function(){
				location.reload() ;
			}
		});
	})
	

	$('.action_cflag').click(function(){
		
		var res = $.ajax({
				url : '/manage/home.userlist',
				type: 'post',
				data: {
					uname 		: $(this).attr('uname'),
					enable  	: $(this).attr('rel'),
					},
				dataType: "json",
				async:false,
				cache:false
			});
			location.reload() ;
//			console.log(res);
	})

})
</script>  
   
  </body>
</html>
