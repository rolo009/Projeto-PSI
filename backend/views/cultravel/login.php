<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;

$this->title = 'Login Área Admin'
?>
<div class="login-container">

    <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-login']); ?>

    <p class="login-info">LOGIN ADMINISTRADOR</p>

    <div class="col-xs-2 col-sm-3 col-md-4 col-lg-4">
    </div>
    <div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model, 'email', ['options' => ['class' => 'label-login']]); ?>
        <?= $form->field($model, 'password', ['options' => ['class' => 'label-login']])->passwordInput(); ?>
        <?= $form->field($model, 'rememberMe')->checkbox()->label("Lembrar-me") ?>

        <div class="form-group">
            <?php
            echo Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-warning', 'name' => 'insert-login']) ?>
            <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="col-xs-2 col-sm-3 col-md-4 col-lg-4">
</div>


