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
          
          <div class="table-responsive">
            <p>模型约定 ：</p>
            <pre>
标准格式

if($this->model->formuser->load($this->Seter->request->post)->update()){
	$this->model->formuser->go();
}else{
	$this->model->formuser->go();
}

说明，成功和失败都会返回ture / false 然后输出消息 -&gt;go()进行json输出</pre>
            pm ： 
          <a href="/pm/" target="_blank">/pm/</a></div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/A/Jquery/jquery-1.11.1.min.js"></script>
    <script src="/A/bootstrap-3.3.4/js/bootstrap.min.js"></script>
    <!-- script src="assets/js/docs.min.js"></script -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   <?php include($this->view_path('debug',1));?>

  </body>
</html>
