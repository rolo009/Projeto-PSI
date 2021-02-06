<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;

$this->title = 'Login';

?>

<div class="login-container">
    <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/logo/seta-logo.png', ['class' => 'logo-login']); ?>

    <p class="login-info">LOGIN</p>

    <div class="row">
        <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>

            <?= $form->field($model, 'email', ['options' => ['class' => 'label-login']]); ?>
            <?= $form->field($model, 'password', ['options' => ['class' => 'label-login']])->passwordInput()->label("Palavra Passe"); ?>
            <?= $form->field($model, 'rememberMe', ['options' => ['class' => 'label-memorizar-sessao']])->checkbox()->label("Manter Sessão Ativa"); ?>

            <div class="form-group">
                <?php
                echo Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-danger', 'name' => 'insert-login']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-xs-1 col-sm-3 col-md-2 col-lg-3">
    </div>
</div>

