<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/../../common/config/siteConfig.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name'=>'七中校内',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        // 'redactor'=>[
        //     'class'=>'yii\redactor\RedactorModule',
        //     'uploadDir'=>'@backend/web/upload',
        //     'uploadUrl'=>'http://localhost:82/upload',
        //     'imageAllowExtensions'=>['jpg','png','gif']
        // ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Adminuser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-backend',
        ],
        'session'=>[
            'name'=>'PHPBACKSESSION',
            'savePath'=>sys_get_temp_dir(),
        ],
        'request'=>[
            'cookieValidationKey'=>'sdsefsasefaesagaku',
            'csrfParam'=>'_adminCSRF',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
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
    'modules' => [
        'content' => [
            'class' => 'backend\modules\content\Module',
        ],
        'test' => [
            'class' => 'backend\modules\test\Module',
        ],
        'guest' => [
            'class' => 'backend\modules\guest\Module',
        ],
        'testService' => [
            'class' => 'backend\modules\testService\Module',
        ],
        'school' => [
            'class' => 'backend\modules\school\Module',
        ],
        'guidance' => [

            'class' => 'backend\modules\guidance\Module',
        ],

    ],
    'params' => $params,
];
