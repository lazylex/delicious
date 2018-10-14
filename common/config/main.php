<?php
return [

    'name'=>'Вкусняшки',
    'language' => 'ru-RU', // язык приложения
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@frontend/runtime/cache',
        ],
        //необходимо также запустить yii migrate --migrationPath=@yii/rbac/migrations
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache'=>'cache'
        ],
    ],
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
        ],
    ],
];
