<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Alterar Palavra-passe';
?>

<div class="resetpassword-container">

    <?= Html::img('@web/seta-logo.png', ['class' => 'logo-resetpassword']); ?>

    <div class="reset-password-info">Alterar Palavra-passe</div>

    <div class="row">
        <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">

    <?php $form = ActiveForm::begin() ?>

    <?php
    echo $form->field($model,'password')->passwordInput()->label('Palavra-Passe Atual', ['options' => ['class' => 'reset-password-info']]);
    echo $form->field($model,'novaPassword',['options' => ['class' => 'reset-password-info']])->passwordInput()->label('Nova Palavra-Passe');
    echo $form->field($model,'confirmNovaPassword',['options' => ['class' => 'reset-password-info']])->passwordInput()->label('Confirmar Nova Palavra-Passe'); ?>

    <div class="form-group">
        <?php
            echo Html::submitButton('Alterar Palavra-Passe', ['class'=>'btn btn-primary']) ?>
        </div>
        </div>
    <?php ActiveForm::end(); ?>
    <div class="col-xs-1 col-sm-3 col-md-2 col-lg-3">
    </div>
</div>