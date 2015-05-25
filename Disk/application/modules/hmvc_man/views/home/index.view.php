<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="/A/bootstrap-3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="/A/CSS/font.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div class="container">

 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">APP 接口管理</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/Man/index">路由</a></li>
            <li><a href="/Man/doc">文档</a></li>
            <li><a href="/Man/model">模块</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

        <h1>&nbsp;</h1>
      <div class="starter-template">
        <h1>接口管理  </h1>
        
        <a class="apiadd">添加</a>
       

<table class="table table-hover table-bordered" >
	  <tr>
	    <td width="40">
        
<!-- GET -->
<a aria-controls="collapseExample" aria-expanded="false" href="#collapseExample31" data-toggle="collapse" class="collapsed"> GET [获取]</a>
<div id="collapseExample31" class="collapse" style=""><br>
    <table class="table table-hover table-condensed table-striped table-bordered" >
    
<?php
foreach($apiget as $key=>$value){
?>
        <tr>
        <td><a class="apiview" sid="<?php echo $value['id']?>"><?php echo $value['api']?></a></td>
        <td><?php echo $value['name']?></td>
        <td><?php echo $value['sort']?></td>
        <td>

          <a class="apiviewlog" sid="<?php echo $value['id']?>" rid=55><span class="glyphicon glyphicon-barcode"></span></a>


          <?php if($value['debug'] ==1){?>
|            <a class="apicenable" sid="<?php echo $value['id']?>" debug=<?php echo $value['debug']?>><span class="glyphicon glyphicon-ok red"></span></a>
          <?php }else{?>
            | <a class="apicenable" sid="<?php echo $value['id']?>" debug=<?php echo $value['debug']?>><span class="glyphicon glyphicon-remove green"></span></a>
          <?php }?>

          <?php if($value['enable'] ==1){?>
            | <a class="apicenable" sid="<?php echo $value['id']?>" enable=<?php echo $value['enable']?>><span class="glyphicon glyphicon-ok-sign green"></span></a>
          <?php }else{?>
            | <a class="apicenable" sid="<?php echo $value['id']?>" enable=<?php echo $value['enable']?>><span class="glyphicon glyphicon-remove-sign red"></span></a>
          <?php }?>

          |  <a class="apiedit" sid="<?php echo $value['id']?>" rel="55"><span class="glyphicon glyphicon-wrench yellow"></span></a>

        </td>
        </tr>
<?php
}
?>


    </table>

</div>         
<!-- GET END -->

        
        
        </td>
      </tr>
	  <tr>
	    <td>
        
<!-- POST -->
<a aria-controls="collapseExample" aria-expanded="false" href="#collapseExample32" data-toggle="collapse" class="collapsed"> POST [新加]</a>
<div id="collapseExample32" class="collapse" style=""><br>
    <table class="table table-hover table-condensed table-striped table-bordered" >
        <tr>
        <td width="40">
        </td>
        <td><a class="apiaddnew">添加新的</a></td>
        <td width="350">映射</td>
        <td width="100">调试</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>GET</td>
        <td>[v1]enter/inlandmodification</td>
        <td> 
        <a class="changedebug" rel=1 rid=54><span class="glyphicon glyphicon-remove-circle green" ></span></a>
        &nbsp; 
        <a class="apiedit" rel="54"><span class="glyphicon glyphicon-wrench yellow"></span></a>
        0            </td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>[v1]-</td>
        <td> 
        <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-ok red"></span></a>
        &nbsp; 
        <a class="apiedit" rel="55"><span class="glyphicon glyphicon-wrench yellow"></span></a>
        0            </td>
        </tr>
    </table>

</div>
<!-- POST END -->
        
        
        
        </td>
      </tr>
      
      
      
<tr>
<td>
        
<!-- put -->
<a aria-controls="collapseExample" aria-expanded="false" href="#collapseExample33" data-toggle="collapse" class="collapsed"> PUT [更新]</a>
<div id="collapseExample33" class="collapse" style=""><br>
    <table class="table table-hover table-condensed table-striped table-bordered" >
        <tr>
        <td width="40">
        </td>
        <td><a class="apiaddnew">添加新的</a></td>
        <td width="350">映射</td>
        <td width="100">调试</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>GET</td>
        <td>[v1]enter/inlandmodification</td>
        <td> 
        <a class="changedebug" rel=1 rid=54><span class="glyphicon glyphicon-remove-circle green" ></span></a>
        &nbsp; 
        <a class="apiedit" rel="54"><span class="glyphicon glyphicon-wrench yellow"></span></a>
        0            </td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>[v1]-</td>
        <td> 
        <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-ok red"></span></a>
        &nbsp; 
        <a class="apiedit" rel="55"><span class="glyphicon glyphicon-wrench yellow"></span></a>
        0            </td>
        </tr>
    </table>

</div>
<!-- PUT END -->
        
        
        
        </td>
      </tr>
      
<tr>
<td>
        
<!-- DELETE -->
<a aria-controls="collapseExample" aria-expanded="false" href="#collapseExample34" data-toggle="collapse" class="collapsed"> DELETE [删除]</a>
<div id="collapseExample34" class="collapse" style=""><br>
    <table class="table table-hover table-condensed table-striped table-bordered" >
        <tr>
        <td width="40">
        </td>
        <td><a class="apiaddnew">添加新的</a></td>
        <td width="350">映射</td>
        <td width="100">调试</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>GET</td>
        <td>[v1]enter/inlandmodification</td>
        <td> 
        <a class="changedebug" rel=1 rid=54><span class="glyphicon glyphicon-remove-circle green" ></span></a>
        &nbsp; 
        <a class="apiedit" rel="54"><span class="glyphicon glyphicon-wrench yellow"></span></a>
        0            </td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>[v1]-</td>
        <td> 
        <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-ok red"></span></a>
        &nbsp; 
        <a class="apiedit" rel="55"><span class="glyphicon glyphicon-wrench yellow"></span></a>
        0            </td>
        </tr>
    </table>

</div>
<!-- DELETE END -->
        
        
        
        </td>
      </tr>      
      
<tr>
<td>
        
<!-- OTHER -->
<a aria-controls="collapseExample" aria-expanded="false" href="#collapseExample35" data-toggle="collapse" class="collapsed"> OTHER [其他]</a>
<div id="collapseExample35" class="collapse" style=""><br>
    <table class="table table-hover table-condensed table-striped table-bordered" >
        <tr>
        <td width="40">
        </td>
        <td><a class="apiaddnew">添加新的</a></td>
        <td width="350">映射</td>
        <td width="100">调试</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>GET</td>
        <td>[v1]enter/inlandmodification</td>
        <td> 
        <a class="changedebug" rel=1 rid=54><span class="glyphicon glyphicon-remove-circle green" ></span></a>
        &nbsp; 
        <a class="apiedit" rel="54"><span class="glyphicon glyphicon-wrench yellow"></span></a>
        0            </td>
        </tr>
        <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>[v1]-</td>
        <td> 
        <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-ok red"></span></a>
        &nbsp; 
        <a class="apiedit" rel="55"><span class="glyphicon glyphicon-wrench yellow"></span></a>
        0            </td>
        </tr>
    </table>

</div>
<!-- GET END -->
        
        
        
        </td>
      </tr>
  <tr>
    <td>

      <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-barcode"></span></a> 日志

      <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-ok red"></span></a> 调试
      <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-remove green"></span></a> 非调试

      <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-ok-sign green"></span></a> 有效
      <a class="changedebug" rel=0 rid=55><span class="glyphicon glyphicon-remove-sign red"></span></a> 无效

    </td>
  </tr>
</table>


       
          
       
 执行时间 <strong>0.0500</strong> 秒
      </div>

    </div><!-- /.container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/A/Jquery/jquery-2.0.3.min.js"></script>
    <script src="/A/artDialog4.1.7/artDialog.js?skin=default"></script>
    <script src="/A/CK.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/A/bootstrap-3.3.4/js/bootstrap.min.js"></script>
	
	<script language="javascript">
    $(document).ready(function(e) {	 
        

	$('.apiview').click(function(){
		$.CK({
			ok:true,
			title:'接口查看模拟',
            rel: '/man/home.view',
			callback:function(){
				location.reload() ;
			}
		});
	})
	
	
	$('.apiedit').click(function(){
		$.CK({
			ok:true,
			title:'接口编辑',
            rel: '/man/home.Apiedit',
			callback:function(){
				location.reload() ;
			}
		});
	})


        $('.apiviewlog').click(function(){
            $.CK({
                ok:true,
                title:'查看日志',
                rel: '/man/home.Viewlog',
                callback:function(){
                    location.reload() ;
                }
            });
        })

        $('.apiadd').click(function(){
            $.CK({
                ok:true,
                title:'添加接口',
			    rel: '/man/home.apiadd',
                callback:function(){
                    location.reload() ;
                }
            });
        })




	$('.apicenable').click(function(){
		
		var res = $.ajax({
				url : '/man',
				type: 'post',
				data: {
                      id 		: $(this).attr('sid'),
                      enable 	: $(this).attr('enable'),
                      debug  	: $(this).attr('debug'),
					},
				dataType: "json",
				async:false,
				cache:false
			});
			location.reload() ;
        })

    });
    </script>


















  </body>
</html>
