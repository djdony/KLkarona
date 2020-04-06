<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

require_once(__DIR__ . '/functions.php');


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name' => 'Admin Panel',
    'homeUrl' => 'admin',


    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'defaultRoute' => 'main',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main',
            'defaultRoute' => 'default/index',

        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],



        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\admin\models\BackendUser',
            'enableAutoLogin' => false,
            'loginUrl' => '/admin/auth/login',
        ],
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],


        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],

        /*'generators' => [
            'migrik' => [
                'class' => \insolita\migrik\gii\StructureGenerator::class,
                'templates' => [
                    'custom' => '@backend/gii/templates/migrator_schema',
                ],
            ],
            'migrikdata' => [
                'class' => \insolita\migrik\gii\DataGenerator::class,
                'templates' => [
                    'custom' => '@backend/gii/templates/migrator_data',
                ],
            ],
        ]*/
    ];
}

return $config;
