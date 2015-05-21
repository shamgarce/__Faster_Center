<?php include($this->view_path('common/header'));?>
    默认首页 <a href="/welcome.index">/welcome.index</a><br>

    登陆 <a href="/login">login</a><br>
    登出 <a href="/login">login</a><br>





    <div><?php echo $ver;?></div>
<h2>欢迎使用MicroPHP框架。</h2>
<hr style="border-bottom-color:black;border-width: 0 0 2px 0;"/>
<p>控制器位于:application/controllers/welcome.php</p>
<p>视图位于:application/views/welcome.view.php</p>
<p>你可以通过修改index.php里面的配置改变默认控制器</p>

<p>

系统改造： 

0 ： 引入autoload

1 ： 引入表对象

2 ： 因对表单对象

3 ： 引入seter对象

4 ： 引入登陆对象

5 :  引入前段资源对象

6 ： 引入前端动作对象




</p>

<?php include($this->view_path('common/footer'));?>