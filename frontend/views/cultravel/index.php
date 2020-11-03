<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;


use yii\web\AssetBundle;

$this->title = 'Cultravel';
?>
<div class="logo-index-container">

    <?= Html::img('@web/logo-white.png'); ?>

</div>
<div>
    <div class="searchForm-container">
        <?php $form = ActiveForm::begin(['class' => 'login-form form-horizontal']); ?>

        <?php
        echo $form->field($model, 'nomeLocalidade')->label(false);

        echo Html::submitButton('Procurar', ['class' => 'btn btn-warning', 'name' => 'login-button']) ?>
        <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>

        <?php ActiveForm::end(); ?>
        <a class="opcao-pesquisa" href="#"><?= FA::icon("bank") ?>Monumentos</a>
        <a class="opcao-pesquisa" href="#"><i class="fas fa-archway icon-search"></i>Museus</a>
        <a class="opcao-pesquisa" href="#"><i class="fas fa-palette icon-search"></i>Arte</a>
        <a class="opcao-pesquisa" href="#"><i class="fas fa-tree icon-search"></i>Jardins</a>
    </div>
</div>

