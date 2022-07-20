<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'en',
    'sourceLanguage' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'yYy4YYYX8lYyYyQOl8vOcO6ROo7i8twO',
            'baseUrl' => '',
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Register',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        'cat' => [
            'class' => 'app\components\CatComponent',
        ],
        'subcat' => [
            'class' => 'app\components\SubcatComponent',
        ],
        'adminlogin' => [
            'class' => 'app\components\AdminLoginComponent',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['en', 'ru'],
            'enableDefaultLanguageUrlCode' => true,
            'rules' => [
                '' => 'site/index',
                '/login' => 'site/login',
                '/register' => 'site/register',
                '/manageitem' => 'products/manageitem',
                '/manageitem/page/<page:\d+>' => 'products/manageitem',
                '/search' => 'products/search',
                '/search/page/<page:\d+>' => 'products/search',
                '/catitem' => 'products/catitem',
                '/subcatitem' => 'products/subcatitem',
                '/infoitem' => 'products/infoitem',
                '/cartitem' => 'products/cartitem',
                '/orderedit' => 'orders/orderedit',
            ],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    /*'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',*/
                    'class' => 'yii\i18n\DbMessageSource',
                    /*'forceTranslation'=>true,
                    'sourceMessageTable' => '{{%source_message}}',
                    'messageTable' => '{{%message}}',
                    'enableCaching' => true,
                    'cachingDuration' => 10,*/
                    'sourceLanguage' => 'en',
                    'on missingTranslation' => ['app\components\TranslationEventHandler', 'handleMissingTranslation']
                ],
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
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
