<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap',
        'css/site.css',
        'css/css.css',
        'css/css-mario.css',
        'css/css-gustavo.css',
    ];
    public $js = [
    ];
    public $depends = [
        '\rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
