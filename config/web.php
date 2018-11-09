<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'World Culture Forum 2016 Registration System',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute'  => 'default/index',
    'modules'   => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User',
                    /* 'userClassName' => 'app\models\User', */
                    'idField' => 'id',
                    'usernameField' => 'username',
                ],
                'searchClass' => 'dektrium\user\models\UserSearch'
            ],
            'layout' => '@app/views/layouts/dashboard'
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'modelMap' => [
                'User'              => 'app\models\User',
                'RegistrationForm'  => 'app\models\RegistrationForm',
                'LoginForm'         => 'app\models\LoginForm',
            ],
            'controllerMap' => [
                'security' => 'app\controllers\user\SecurityController'
            ],
            'enableConfirmation' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['superadmin'],
            'mailer' => [
                'sender'                => 'secretariat@worldcultureforum-bali.org', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Secretariat World Culture Forum 2016',
                'confirmationSubject'   => 'Secretariat World Culture Forum 2016',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',
            ],
            'layout' => '@app/views/layouts/user'
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
            //'downloadAction' => 'export',
            'downloadAction' => 'gridview/export/download',
        ],
    ],
    'components' => [

        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views',
                ],
            ],
        ],
        
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '<p class="text-center">-</p>',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'j8TQHWfCJsVjKjpuB2rBua1P-MZ9WtmE',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        /*'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],*/
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
            'rules' => [
                // ...

                /*Default URL Manager*/
                '<controller:\w+>/<id:\d+>'=>'<controller>/view/<id:\d+>',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                 'class' => 'Swift_SmtpTransport',
                 'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                 'username' => 'secretariat@worldcultureforum-bali.org',
                 'password' => 'Osing4321',
                 'port' => '587', // Port 25 is a very common port too
                 'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],
            'messageConfig' => [
                'from' => ['secretariat@worldcultureforum-bali.org' => 'Admin'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
/*            'defaultRoles' => ['register'],*/
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'site/index',
            'user/*',
            'default/index',
            'site/captcha'
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
   /* $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];*/

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['192.168.1.*', '*.*.*.*'],
    ];
}

return $config;
