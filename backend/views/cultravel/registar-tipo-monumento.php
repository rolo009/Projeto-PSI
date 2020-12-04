<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="registar-tipo-monumento-form">
    <div class="logo">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-registar']); ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput()->label("Tipo de Monumento"); ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
