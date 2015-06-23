<?php  if ( ! defined('SHAM_PATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| the active record class
*/

$config = [

    'route' =>[
        'style' => 'mix',       //混合模式  //path //query
    ],
    'default' =>[
        "hostname"  =>  '127.0.0.1',
        "username"  =>  'ns',
        "password"  =>  'nsgd012003',
        "database"  =>  'ns',
        "charset"   =>  'utf8',
        "pconnect"  =>  '0',
        "quiet"     =>  '0'
    ],
    'obj'=>[
        [
            'classname'=>'db',
            'class'=>'\Seter\Library\SDb',
            'parm'=>'',
        ],
        [
            'classname'=>'doc',
            'class'=>'\Seter\Library\Doc',
            'parm'=>'',
        ],
        [
            'classname'=>'request',
            'class'=>'\Seter\Library\Request',
            'parm'=>'',
        ],
        [
            'classname'=>'user',
            'class'=>'\Seter\Library\VUser',
            'parm'=>'f_user',
        ],
        [
            'classname'=>'mdb',
            'class'=>'\Seter\Library\Mdb',
            'parm'=>'',
        ],
        [
            'classname'=>'table',
            'class'=>'\Seter\Library\Table',
            'parm'=>'',
        ],
    ]
];

return $config;
