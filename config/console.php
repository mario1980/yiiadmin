<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    // 手动保存一些有用的失败的操作日志，使用方法：Yii::info("失败说明", 'fail');
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['custom/fail'],
                    'logFile' => '@app/runtime/logs/custom/fail.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                    'logVars' => [],
                ],
                [
                    // 手动保存一些有用的成功的操作日志，使用方法：Yii::info("成功说明", 'success');
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['custom/success'],
                    'logFile' => '@app/runtime/logs/custom/success.log',
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 50,
                    'logVars' => [],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];
