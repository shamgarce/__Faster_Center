<?php

//echo __NAMESPACE__;
//use RedBeanPHP;

require_once('\plus\RedBean\rb.php');
R::setup( 'mysql:host=127.0.0.1;dbname=ns','root', 'root3306' );




//$book = \R::load( 'dy_user', 1 );
//$book = \R::findAll( 'dy_user');
$books = R::findAll( 'dy_user' );
foreach($books as $key=>$value){
    print_r($value);
    echo $value['user_id'];
}
exit;