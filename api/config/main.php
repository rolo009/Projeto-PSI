<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
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
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/pontosturisticos',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET search/{pesquisa}' => 'search',
                        'GET tipomonumento/{tipo}' => 'tipomonumento',
                        'GET estatisticas/{id}' => 'estatisticas',
                        'GET localidade/{local}' => 'localidade', //não reconhece
                        'GET info' => 'info', //não reconhece
                    ],
                    'tokens' => [
                        '{id}' => '<id:\d+>',
                        '{local}' => '<local:.*?>',
                        '{tipo}' => '<tipo:.*?>',
                        '{pesquisa}' => '<pesquisa:.*?>',
                    ],
                ],
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/userprofile',
                    'pluralize' => false,
                    'except' => ['delete', 'create', 'update', 'view'],
                    'extraPatterns' => [
                        'GET info/{id}' => 'info',
                        'PATCH apagaruser/{token}' => 'apagaruser',
                        'POST registo' => 'registo',
                        'GET user/{token}' => 'user',
                        'PUT editar' => 'editar',
                        'POST login' => 'login',
                    ],
                    'tokens' => [
                        '{id}' => '<id:\d+>',
                        '{token}' => '<token:.*?>',
                    ],
                ],

                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/contactos',
                    'pluralize' => false,
                    'except' => ['delete', 'update'],
                    'extraPatterns' => [
                        'GET mensagem/{id}' => 'mensagem',
                        'GET naolidas' => 'naolidas',
                        'GET lidas' => 'lidas',
                        'POST registo' => 'registo'
                    ],
                ],
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/favoritos',
                    'pluralize' => false,
                    'except' => ['update'],
                    'extraPatterns' => [
                        'GET info/{token}' => 'info',
                        'POST add' => 'add',
                        'DELETE remover/{id}/{token}' => 'remover',
                        'GET check/{id}/{token}' => 'check',
                    ],
                    'tokens' => [
                        '{token}' => '<token:.*?>',
                        '{id}' => '<id:\d+>',
                    ],
                ],
            ]

        ],
        'urlManagerBackend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '../../backend/web/imagens',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'params' => $params,
];



