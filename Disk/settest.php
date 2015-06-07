<?php

define('IN_WONIU_APP', TRUE);
define('WDS', DIRECTORY_SEPARATOR);
//Sham Seter
define('SALT', 'ccab8f440ff0825e');

include('Seter/Seter.php');



$s = new \Seter\Seter();

$s['asdf'] = 123;
unset($s['asdf']);
var_dump($s);

echo 1;