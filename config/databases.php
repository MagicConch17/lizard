<?php
/**
 * databases.php
 * author          :  yxk
 * createTime      : 2019/11/18 11:24
 * descripition    :
 */

$debug = false;

$config = [
    'mysql' => [
        'database_type'    => 'mysql', // Db driver
        'server'      => '127.0.0.1',
        'port' => '3306',
        'database_name'  => 'test',
        'username'  => 'root',
        'password'  => '',
        'charset'   => 'utf8', // Optional
        'collation' => 'utf8_unicode_ci', // Optional

    ],
    'mongodb' => [
        'connection' => [
            'hostnames' => '127.0.0.1',// mongodb 地址
            'database'  => '',// 数据库名
            'options'  => [
                "connectTimeoutMS" => 500 ,
                "username" => "",// 用户名
                "password" => "",// 密码
                "authSource" => "" // 验证数据库
            ]
        ]
    ]
];

return $config;

