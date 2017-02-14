<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'aliases' => [
        'race' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'race'
        ),
        'sport' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'sport'
        ),
        'user' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'user'
        ),
        'distance' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'distance'
        ),
        'organizer' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'organizer'
        ),
        'coach' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'coach'
        ),
        'post' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'post'
        ),
        'page' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'page'
        ),
        'product' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'product'
        ),
        'configuration' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'configuration'
        ),
        'metalguardian' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'metalguardian'
        ),
        'seo' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'seo'
        ),
        'promo' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'promo'
        ),
        'promocode' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'promocode'
        ),
    ],
    'modules' => [
        'race' => [
            'class' => 'race\RaceModule',
        ],
        'sport' => [
            'class' => 'sport\SportModule',
        ],
        'user' => [
            'class' => 'user\UserModule',
        ],
        'distance' => [
            'class' => 'distance\DistanceModule',
        ],
        'organizer' => [
            'class' => 'organizer\OrganizerModule',
        ],
        'coach' => [
            'class' => 'coach\CoachModule',
        ],
        'post' => [
            'class' => 'post\PostModule',
        ],
        'page' => [
            'class' => 'page\PageModule',
        ],
        'product' => [
            'class' => 'product\ProductModule',
        ],
        'configuration' => [
            'class' => 'configuration\ConfigurationModule',
        ],
        'fileProcessor' => [
            'class' => 'metalguardian\fileProcessor\Module',
            'imageSections' => [
                'news' => [
                    'preview' => [
                        'action' => 'adaptiveThumbnail',
                        'width' => 100,
                        'height' => 100,
                    ],
                ],
            ],
        ],
        'seo' => [
            'class' => 'seo\SeoModule'
        ],
        'promo' => [
            'class' => 'promo\PromoModule'
        ],
        'promocode' => [
            'class' => 'promocode\PromocodeModule',
        ],
        'permit' => [
            'class' => 'developeruz\db_rbac\Yii2DbRbac',
            'theme' => [
                'pathMap' => ['@vendor/developeruz/yii2-db-rbac/views/access' => '@backend/views/access'],
            ],
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js'=>[]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],

            ],
        ],


        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                '<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ),
        ],

    ],
    'as AccessBehavior' => [
        'class' => developeruz\db_rbac\behaviors\AccessBehavior::className(),
        'rules' =>
            [
                'site' =>
                    [
                        [
                            'actions' => ['error', 'login', 'logout'],
                            'allow' => true,
                        ],
                        [
                            'actions' => ['index'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                'debug/default' =>
                    [
                        [
                            'actions' => [],
                            'allow' => true,
                        ],
                    ]
            ],
    ],
    'params' => $params,
];
