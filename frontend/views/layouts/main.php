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
        'brandLabel' => "Cultravel",
        'brandUrl' => ['/cultravel/index'],
        'options' => [
            'class' => 'menu-style navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/cultravel/index']],
        ['label' => 'Favoritos', 'url' => ['/cultravel/favoritos']],
        ['label' => 'Visitados', 'url' => ['/cultravel/visitados']],
        ['label' => 'Contactos', 'url' => ['/cultravel/contactos']],
        ['label' => 'Sobre Nós', 'url' => ['/cultravel/sobreNos']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItemsUser[] = ['label' => 'Signup', 'url' => ['/cultravel/registar']];
        $menuItemsUser[] = ['label' => 'Login', 'url' => ['/cultravel/login']];
    } else {
        $menuItemsUser[] = '<li>'
            . Html::beginForm(['/registar/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
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
