<ul class="nav nav-sidebar">

<?php
foreach($menu['list'] as $key=>$value){  
?>
    <li <?php if($menu['local'] == $key){?>class="active"<?php }?>><a href="/manage/<?php echo $key;?>"><?php echo $value;?></a></li>
<?php
}    
?>
    
</ul>