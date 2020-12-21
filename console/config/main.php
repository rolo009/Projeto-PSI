<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/pontosturisticos',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET pontosturisticos' => 'mvisitado',
                        'GET estatisticas/{id}' => 'estatisticas',
                        'GET localidade/{local}' => 'localidade', //não reconhece
                    ],
                ],

                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/userprofile',
                    'pluralize' => false,
                    'except' => ['delete', 'create'],
                    'extraPatterns' => [
                        'GET mvisitado' => 'mvisitado',
                        'GET info/{id}' => 'info', //recolhe info da tabela user e userprofile
                        'PUT baniruser/{id}' => 'baniruser',
                    ],
                ],

                ['class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/contactos',
                    'pluralize' => false,
                    'except' => ['delete', 'create'],
                    'extraPatterns' => [
                        'GET mensagem/{id}' => 'mensagem',
                        'GET naolidas' => 'naolidas',
                        'GET lidas' => 'lidas'
                    ],
                ]
            ],
        ],
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\Module',
        ],
    ],
    'params' => $params,
];
