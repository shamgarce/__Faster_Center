<div class="clear"></div> 
<style type="text/css">
/* rightNav 容器*/
.rightNavFloat{position:fixed;top:0;right:-500px;z-index:9999;width:500px;cursor:pointer;margin:80px 0 0 0;}

.rightNavFloat_five{right:00px;}
*html .rightNavFloat{position:absolute;top:expression(eval(document.documentElement.scrollTop));}
.rightNavFloat a{display:block;position:relative;height:30px;line-height:30px;margin-bottom:2px;background:#eee;padding-right:10px;width:500px;overflow:hidden;cursor:pointer;right:0px;left:-30px;}
.rightNavFloat a:hover{text-decoration:none;color:#1974A1;}
.rightNavFloat a:hover em{background:#00b700}
.rightNavFloat a em{display:block;float:left;width:30px;background:black;color:#fff;font-size:16px;text-align:center;margin-right:10px;font-style:normal;}
</style>
<div class="rightNavFloat">
    <a class="footerbtn1" class="v0" rel="bootstrap"><em>D</em>bootstrap</a>
    <div style="background:#FFF;width:500px;height:800px;overflow-y:auto;"><pre>
<?php
echo print_r($data,true);
//dump($this->Seter);
?>
</pre>
还需要什么信息<br />
内存<br />
环境<br />
数据库查询次数<br />
调用了哪些依赖对象<br />
等等
</div>
</div>
<script type="text/javascript">
$(function () {
	$('.footerbtn1').click(function() {
		if($('.footerbtn1').attr('states')=='vst'){
			$('.rightNavFloat').removeClass('rightNavFloat_five');
			$('.footerbtn1').attr('states','vstt');
		}else{
			$('.rightNavFloat').addClass('rightNavFloat_five')
			$('.footerbtn1').attr('states','vst');
		}
	});
});
</script>
