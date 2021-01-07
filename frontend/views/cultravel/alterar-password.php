<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<div class="alterar-password-container">
    <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-editar']); ?>

    <div class="editar-info">Alterar Palavra-Passe</div>

    <div class="row">
        <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'password', ['options' => ['class' => 'label-registo']])->passwordInput()->label('Palavra-Passe Atual') ?>

            <?= $form->field($model, 'novaPassword' ,['options' => ['class' => 'label-registo']])->passwordInput()->label('Nova Palavra-Passe') ?>

            <?= $form->field($model, 'confirmNovaPassword',['options' => ['class' => 'label-registo']])->passwordInput()->label('Confirmar Nova Palavra-Passe') ?>

            <div class="form-group">
                    <?= Html::submitButton('Alterar Palavra-Passe', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-xs-1 col-sm-3 col-md-2 col-lg-3">
    </div>
</div>