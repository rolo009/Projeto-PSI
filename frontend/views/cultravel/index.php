<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;


use yii\web\AssetBundle;

$this->title = 'Cultravel';
?>
<div class="logo-index-container">

    <?= Html::img('@web/logo-white.png'); ?>

</div>
<div>
    <div class="searchForm-container">
        <?php $form = ActiveForm::begin(['layout' => 'horizontal'])?>

        <?php
        echo $form->field($model, 'nomeLocalidade')->label(false);

        echo Html::submitButton('Procurar', ['class' => 'btn btn-warning', 'name' => 'search-localidade']) ?>
        <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>
        <?php ActiveForm::end(); ?>
        <a class="opcao-pesquisa" href="#"><?= FA::icon("bank", ['class' => 'icon-index-search']) ?>Monumentos</a>
        <a class="opcao-pesquisa" href="#"><?= FA::icon("bank", ['class' => 'icon-index-search']) ?></i>Museus</a>

    </div>
</div>

