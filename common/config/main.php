<?php
return [
    'language'=>'ru',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        /*
        'soap' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:8090/wsdl/IOrionPro',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
        */
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        
    ],
];
