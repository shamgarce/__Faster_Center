<?php include($this->view_path('common/manageheader',1));?>


  <body>
  
  <pre>&lt;script language=&quot;javascript&quot;&gt;<br>$(document).ready(function(){<br>	<br>})<br>&lt;/script&gt;  </pre>
  
  
<?php
foreach($dialog as $key=>$value){
?>
<a class="dialogtest" rel="<?php echo $value['uri'];?>" ident="1"><?php echo $value['title'];?></a><hr>

  <pre>$('.dialog').click(function(){<br>	$.CK({<br>		ok:true,<br>		rel: $(this).attr('<?php echo $value['uri'];?>')<br>	});<br>})<br>
  </pre>
  
<?php
}
?>
  
  
  
  
  
  
  
  
  
  
    <script src="/A/Jquery/jquery-1.11.1.js"></script>

  <script src="/A/bootstrap-3.3.4/js/bootstrap.min.js"></script>
  <script src="/A/artDialog4.1.7/artDialog.js?skin=default"></script>
  <script src="/A/CK.js"></script>
    
<script language="javascript">
$(document).ready(function(){
	$('.dialogtest').click(function(){
		$.CK({
			ok:true,
			rel: $(this).attr('rel')
		});
	})
	
})
</script>    
    
  <!-- script src="assets/js/docs.min.js"></script -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   
  </body>
</html>
