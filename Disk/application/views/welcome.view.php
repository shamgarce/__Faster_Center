<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>超管理 - <?php echo $title;?></title>

    <!-- Bootstrap core CSS -->
    <link href="/A/bootstrap-3.3.4/css/bootstrap.css" rel="stylesheet">
    <link href="/A/CSS/font.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/A/U/u1/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>  <body>
    <div class="container" style="padding-top:150px;width:300px">
<? //=123;?>    
<? //php phpinfo();?>

        <h2 class="form-signin-heading">管理系统</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="uname" type="text" id="inputEmail" class="form-control username" placeholder="用户名" required autofocus>
        <div class="checkbox">
        </div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="pwd" type="password" id="inputPassword" class="form-control password" placeholder="密码" required>
        <div class="checkbox">
        </div>
        <button class="btn btn-lg btn-primary btn-block login_submit" type="submit">登陆</button>
   

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/A/jquery/jquery-1.11.1.min.js"></script>
    <script src="/A/bootstrap-3.3.4/js/bootstrap.min.js"></script>
    <!-- script src="assets/js/docs.min.js"></script -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    
    
<script language="javascript"> 
$(document).ready(function(){
	
	$(".login_submit").click(function(){


		var res = $.ajax({
			url : '/manage/home.login',
			type: 'post',
			data: {
				uname 	: $("input[name='uname']").val(),
				pwd 	: $("input[name='pwd']").val(),
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
//			location.reload();
			window.location.href="<?php echo $re?>";
			return true;
		}		
		
	});	
	
}) 
</script> 
   
  </body>
</html>
