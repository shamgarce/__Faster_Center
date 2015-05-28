<?php include($this->view_path('common/manageheader',1));?>


  <body>

    <div class="container" style="padding-top:150px;width:300px">


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
			url : '/manage/home.logintest',
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
			//location.reload();
			 window.location.href="/manage/";
			return true;
		}		
		
	});	
	
}) 
</script> 
   
  </body>
</html>
