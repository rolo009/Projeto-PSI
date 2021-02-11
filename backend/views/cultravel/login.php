<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login Área Administrador'
?>

<div class="login-container">
<div class="login-container-input">
    <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-login']); ?>

    <p class="login-info">LOGIN ADMINISTRADOR</p>

    <div class="col-xs-2 col-sm-3 col-md-4 col-lg-4">
    </div>
    <div class="col-xs-8 col-sm-6 col-md-4 col-lg-4">
        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

        <?= $form->field($model, 'email', ['options' => ['class' => 'label-login']]); ?>
        <?= $form->field($model, 'password', ['options' => ['class' => 'label-login']])->passwordInput()->label('Palavra-Passe'); ?>
        <?= $form->field($model, 'rememberMe', ['options' => ['class' => 'label-lembrar-me']])->checkbox()->label("Lembrar-me") ?>

        <div class="form-group">
            <?php
            echo Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-danger', 'name' => 'insert-login']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
<div class="col-xs-2 col-sm-3 col-md-4 col-lg-4">
</div>


