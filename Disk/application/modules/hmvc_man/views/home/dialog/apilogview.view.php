<?php

foreach($loglist as $key=>$value){
?>


<div class="panel panel-default">
  <div class="panel-body">


<p><?=$value['router']['c']?>/<?=$value['router']['m']?>/<br />

<?=$value['code']?>/<?=$value['msg']?>/<?=$value['time']['timecu']?>/ </p>
<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs" role="tabpanel">
  <ul id="myTab" class="nav nav-tabs" role="tablist">
    <li class="active" role="presentation">
      <a id="home-tab" aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" href="#POST<?php echo $key?>">POST -<?php echo $key?></a>
    </li>
    <li class="" role="presentation">
      <a id="profile-tab" aria-controls="profile" data-toggle="tab" role="tab" href="#GET<?php echo $key?>" aria-expanded="false">GET</a>
    </li>
    
      <li class="" role="presentation">
      <a id="home2-tab" aria-expanded="true" aria-controls="home" data-toggle="tab" role="tab" href="#ROUTER<?php echo $key?>">ROUTER</a>
    </li>
    <li class="" role="presentation">
      <a id="profile-tab" aria-controls="profile" data-toggle="tab" role="tab" href="#SIGN<?php echo $key?>" aria-expanded="false">SIGN</a>
    </li>
    </ul>
  <div id="myTabContent" class="tab-content">
    <div id="POST<?php echo $key?>" class="tab-pane fade active in" aria-labelledby="home-tab" role="tabpanel">
<p><pre>
<?php
print_r($value['_POST']);
?>
</pre></p>
    </div>
    <div id="GET<?php echo $key?>" class="tab-pane fade" aria-labelledby="profile-tab" role="tabpanel">
      <p><pre>
<?php
print_r($value['_GET']);
?>
</pre></p>
    </div>
    <div id="ROUTER<?php echo $key?>" class="tab-pane fade" aria-labelledby="profile-tab" role="tabpanel">
      <p><pre>
<?php
print_r($value['router']);
?>
</pre></p>
    </div>
    <div id="SIGN<?php echo $key?>" class="tab-pane fade" aria-labelledby="profile-tab" role="tabpanel">
      <p><pre>
<?php
print_r($value['sign']);
?>
</pre></p>
    </div>
    
    
  </div>   
  
  
  </div>
</div>



<?php }?>
