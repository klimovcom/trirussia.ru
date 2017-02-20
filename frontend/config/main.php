<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
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
        'metalguardian' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'metalguardian'
        ),
        'willGo' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'willGo'
        ),
        'post' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'post'
        ),
        'promo' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'promo'
        ),
        'seo' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'seo'
        ),
        'configuration' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'configuration'
        ),
        'product' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'product'
        ),
        'promocode' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'promocode'
        ),
        'coach' => realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'modules' .
            DIRECTORY_SEPARATOR . 'coach'
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
        'willGo' => [
            'class' => 'willGo\WillGoModule',
        ],
        'post' => [
            'class' => 'post\PostModule',
        ],
        'promo' => [
            'class' => 'promo\PromoModule',
        ],
        'seo' => [
            'class' => 'seo\SeoModule',
        ],
        'configuration' => [
            'class' => 'configuration\ConfigurationModule',
        ],
        'product' => [
            'class' => 'product\ProductModule',
        ],
        'promocode' => [
            'class' => 'promocode\PromocodeModule',
        ],
        'coach' => [
            'class' => 'coach\CoachModule',
        ],

    ],
    'controllerNamespace' => 'frontend\controllers',
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
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'medium',
        ],

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [

                '/races.php?id=<url>' => '/race/<url>',
                'sitemap.xml' => 'site/sitemap',
                //static pages
                //TODO: move to page module
                '/domains' => '/site/domains',
                '/advertising' => '/site/advertising',
                '/about' => '/site/about',
                '/calendar' => '/site/calendar',
                '/bmi' => '/site/bmi',
                '/convert' => '/site/convert',
                '/privacy' => '/site/privacy',
                'site/auth' => 'site/auth',
                'site/logout' => 'site/logout',

                '/magazine' => '/post/default/index',
                '/magazine/search' => '/post/default/search',
                'magazine/<url>' => 'post/default/view',

                'organizer' => 'organizer/default/index',

                'race/add' => 'race/default/create',
                'race/advanced' => 'race/default/advanced',
                'race/<url>' => 'race/default/view',
                'race/default/render-distance-list' => 'race/default/render-distance-list',
                'race/default/set-rating' => 'race/default/set-rating',
                'race/default/update-search-distance' => 'race/default/update-search-distance',
                'race/default/update-url' => 'race/default/update-url',
                'race/default/get-more-races' => 'race/default/get-more-races',

                '/search-races' => '/site/search-races',

                'shop' => 'product/default/index',
                'shop/cart' => 'product/default/cart',
                'shop/delivery' => 'product/default/delivery',
                'shop/payment/<label>' => 'product/default/payment',
                'shop/<url>' => 'product/default/view',
                'product/default/add-product-to-cart' => 'product/default/add-product-to-cart',
                'product/default/change-cart-position-count' => 'product/default/change-cart-position-count',
                'product/default/remove-cart-position' => 'product/default/remove-cart-position',
                'yandex-money-check' => 'product/default/yandex-money-check',

                'promocodes' => 'promocode/default/index',

                'training' => 'coach/default/index',
                'training/<url>' => 'coach/default/view',

                'willGo/default/remove-will-go' => 'willGo/default/remove-will-go',
                'willGo/default/add-will-go' => 'willGo/default/add-will-go',

                '<sport:\w+>' => '/site/sport',

                '/' => '/site/index',
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    /*'clientId' => '1178666168819901',
                    'clientSecret' => 'd9fe46df955d39c1962aa9925b609a5b',*/
                    'clientId' => '597412183700544',
                    'clientSecret' => 'ae62e4a11fbd879e9394ae8001088253',
                    'attributeNames' => ['name', 'email', 'age_range', 'gender', 'locale', 'timezone', 'picture'],
                ],
            ],
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'trirussia_cart',
        ],
        'view' => [
            'class' => '\rmrevin\yii\minify\View',
            'enableMinify' => true,//!YII_DEBUG,
            'web_path' => '@web', // path alias to web base
            'base_path' => '@webroot', // path alias to web base
            'minify_path' => '@webroot/minify', // path alias to save minify result
            'js_position' => [ \yii\web\View::POS_END ], // positions of js files to be minified
            'force_charset' => 'UTF-8', // charset forcibly assign, otherwise will use all of the files found charset
            'expand_imports' => true, // whether to change @import on content
            'compress_output' => false, // compress result html page
            'compress_options' => ['extra' => true], // options for compress
            'concatCss' => true, // concatenate css
            'minifyCss' => true, // minificate css
            'concatJs' => true, // concatenate js
            'minifyJs' => true, // minificate js
            'excludeBundles' => [
                //\frontend\assets\AssetBundle::class, // exclude this bundle from minification
            ],
        ],
    ],
    'params' => $params,
];
