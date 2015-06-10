<?php include($this->view_path('common/manageheader'));?>


  <body>

  <?php include($this->view_path('common/managenavtop'));?>


    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <?php include($this->view_path('common/managenavleft'));?>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">




          
          <h1 class="page-header"><?php echo $title ?></h1>
<div class="panel panel-default">
  <div class="panel-body">
  
        <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          添加用户组
        </a>
        <!-- button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Button with data-target
        </button -->
        </p>
        
        <div class="collapse" id="collapseExample">
          <div class="well">
           
           
<table class="table table-striped table-hover">
<tbody>
	<tr>
        <td width="100" align="right">组名 :</th>
        <td width="300"><input type="text" class="form-control" placeholder="Enter email"></td>
        <td align="left">说明</td>
    </tr>
	<tr>
        <td align="right">组chr : </th>
        <td><input type="text" class="form-control" placeholder="Enter email"></td>
        <td align="left">说明</td>
    </tr>
	<tr>
        <td align="right">sort : </th>
        <td><input type="text" class="form-control" placeholder="Enter email"></td>
        <td align="left">说明</td>
    </tr>
	<tr>
        <td align="right">组名</th>
:        <td><input type="text" class="form-control" placeholder="Enter email"></td>
        <td align="left">说明</td>
    </tr>
</tbody>           
</table>    
           
          </div>
        </div>
  </div>
</div>
        
        
<div class="panel panel-default">
  <div class="panel-body">
  
  <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th width="100">groupid</th>
                  <th>组名</th>
                  <th>组chr</th>
                  <th width="150">sort</th>
                  <th width="150">有效</th>
                  <th width="150">操作</th>
                </tr>
              </thead>
              <tbody>
<?php foreach($list as $key=>$value){?>
                <tr>
                  <td width="100"><?php echo $value['groupid']?></th>
                  <td><?php echo $value['groupname']?></td>
                  <td><?php echo $value['groupchr']?></td>
                  <td><?php echo $value['sort']?></td>
                  <td>
                  
<?php
if($value['enable']){
?>
<a class="action_cflag" rel="1" groupid="<?php echo $value['groupid']?>" href="javascript:void(0)">
<span class=" glyphicon glyphicon-ok green"></span>
</a>
<?php }else{?>
<a class="action_cflag" rel="0" groupid="<?php echo $value['groupid']?>" href="javascript:void(0)">
<span class=" glyphicon glyphicon-remove red"></span>
</a>                  
<?php
}
?>  				  
                  </td>
                  <td><a class="btn btn-danger btn-sm useredit" rel="19">修改</a></td>
                </tr>
<?php }?>

              </tbody>
	</table>              
 
 
 
  </div>
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
//	$('.useradd').click(function(){
//		$.CK({
//			ok:true,
//			title:'添加用户',
//			rel: '/manage/home.useradd',
//			callback:function(){
//				location.reload() ;
//			}
//		});
//	})
	
//	$('.useredit').click(function(){
//		$.CK({
//			ok:true,
//			title:'添加用户',
//			rel: '/manage/home.useredit/'+ $(this).attr('rel'),
//			callback:function(){
//				location.reload() ;
//			}
//		});
//	})
	

	//$('.action_cflag').click(function(){
		
//		var res = $.ajax({
//				url : '/manage/home.userlist',
//				type: 'post',
//				data: {
//					uname 		: $(this).attr('uname'),
//					enable  	: $(this).attr('rel'),
//					},
//				dataType: "json",
//				async:false,
//				cache:false
//			});
//			location.reload() ;
////			console.log(res);
	//})

})
</script>  
    <?php include($this->view_path('debug',1));?>

  </body>
</html>
