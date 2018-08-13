<?php
return [

    'name'=>'Вкусняшки',

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //необходимо также запустить yii migrate --migrationPath=@yii/rbac/migrations
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache'=>'cache'
        ],
    ],
];
