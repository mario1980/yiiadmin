<?php

require (__DIR__ . '/domains.php');
$params = require (__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log'
    ],
    'name' => 'themeforest',
    'language' => 'zh_CN',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'aliases' => [
        '@mdm/admin' => dirname(__DIR__) . "/vendor/mdmsoft/yii2-admin/"
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/basic'],
                'baseUrl' => '@web/themes/basic',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'adfaHQ#$DFF-BS(FLWHL'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache'
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true
        ],
        'errorHandler' => [
            'errorAction' => '/public/error'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ]
                ]
            ]
        ],
        'db' => require (__DIR__ . '/db.php'),
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'auth_item',
            'assignmentTable' => 'auth_assignment',
            'itemChildTable' => 'auth_item_child'
        ]
    ],
    'modules' => require (__DIR__ . '/modules.php'),
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            '*',
            //'admin/*', // add or remove allowed actions to this list
        ]
    ],
    'params' => $params
];

if (YII_ENV_DEV)
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
