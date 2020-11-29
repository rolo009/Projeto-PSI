<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
            . Html::beginForm(['/cultravel/logout'], 'post')
            . Html::submitButton(
                'TERMINAR SESSÃO (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
            . Html::beginForm(['/cultravel/editar-registo'], 'post')
            . Html::submitButton(
                'Alterar Dados Pessoais',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>'
            . '</li>'
            . Html::beginForm(['/site/resetPassword'], 'post')
            . Html::submitButton(
                'Alterar Palavra-passe',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
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
