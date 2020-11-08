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
    <div class="container-fluid searchForm-container">
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <?= $form->field($model, 'nomeLocalidade')->label(false); ?>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <?= Html::submitButton('Procurar', ['class' => 'btn btn-warning btn-search-index', 'name' => 'search-localidade']) ?>
            </div>
        </div>
        <div class="row">
            <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>
            <?php ActiveForm::end(); ?>
            <a class="opcao-pesquisa" href="#"><?= FA::icon("bank", ['class' => 'icon-index-search']) ?>Monumentos</a>
            <a class="opcao-pesquisa" href="#"><?= FA::icon("bank", ['class' => 'icon-index-search']) ?>Museus</a>
        </div>
    </div>
</div>

