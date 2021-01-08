<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="index-background">
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' =>  "CULTRAVEL",
        'brandUrl' => ['/cultravel/index'],
        'options' => [
            'class' => 'menu-style navbar-fixed-top',
        ],
    ]);
    if(Yii::$app->user->isGuest){
        $menuItems = [
            ['label' => 'HOME', 'url' => ['/cultravel/index']],
            ['label' => 'CONTACTOS', 'url' => ['/cultravel/contactos']],
            ['label' => 'SOBRE NÓS', 'url' => ['/cultravel/sobre-nos']],
        ];
    }
    else{
        $menuItems = [
            ['label' => 'HOME', 'url' => ['/cultravel/index']],
            ['label' => 'FAVORITOS', 'url' => ['/cultravel/favoritos']],
            ['label' => 'VISITADOS', 'url' => ['/cultravel/visitados']],
            ['label' => 'CONTACTOS', 'url' => ['/cultravel/contactos']],
            ['label' => 'SOBRE NÓS', 'url' => ['/cultravel/sobre-nos']],
        ];
    }

    if (Yii::$app->user->isGuest) {
        $menuItemsUser[] = ['label' => 'REGISTAR', 'url' => ['/cultravel/registar']];
        $menuItemsUser[] = ['label' => 'INICIAR SESSÃO', 'url' => ['/cultravel/login']];
    } else {
        $menuItemsUser[] = '<li>'
            . '<a data-toggle="dropdown" class="dropdown-toggle">ÁREA PESSOAL<b class="caret"></b></a>'
            . Dropdown::widget([
                'items' => [
                    ['label' => 'Alterar Dados Pessoais', 'url' => ['/cultravel/editar-registo'], 'options' => ['class' => 'dropdown-item']],
                    ['label' => 'Alterar Palavra-passe', 'url' => ['/cultravel/alterar-password'], 'options' => ['class' => 'dropdown-item']],
                    ['label' => 'Logout ('. Yii::$app->user->identity->username .')', 'url' => ['/cultravel/logout'], 'options' => ['class' => 'dropdown-item']],
                ],
            ])
            . '</li>';
    }
    ?>

        <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left menu-options'],
        'items' => $menuItems,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItemsUser,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<?php /*
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
*/?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
