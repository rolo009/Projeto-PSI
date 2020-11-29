<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="registar-localidade-form">

    <div class="logo">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-registar']); ?>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeLocalidade')->textInput()->label("Localidade"); ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>