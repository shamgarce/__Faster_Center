
<table class="table table-hover table-condensed table-striped table-bordered" width="700px;" >

<?php

foreach($loglist as $key=>$value){
?>
<tr>
  <td>
<?=$value['router']['c']?>/<?=$value['router']['m']?>/<br />

<?=$value['code']?>/<?=$value['msg']?>/<?=$value['time']['timecu']?>/ <br />

<?php echo $key?> - ROUTER:<br />
<pre>
<?php
print_r($value['router']);
?>
</pre>

<?php echo $key?> - SIGN:<br />
<pre>
<?php
print_r($value['sign']);
?>
</pre>


<?php echo $key?> - POST:<br />
<pre>
<?php
print_r($value['_POST']);
?>
</pre>


<?php echo $key?> - GET:<br />
<pre>
<?php
print_r($value['_GET']);
?>
</pre>


  </td>
</tr>
<?php }?>


</table>


