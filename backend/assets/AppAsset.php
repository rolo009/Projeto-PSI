<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap',
        '//fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet',
        '//fonts.googleapis.com/css2?family=Nunito:wght@300;400&display=swap',
        'css/site.css',
        'css/css.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
