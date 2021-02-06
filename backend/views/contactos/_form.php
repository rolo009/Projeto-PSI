<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contactos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contactos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropdownList(
            ['0' => 'Mensagem não Lida', '1' => 'Mensagem Lida'],
        ['prompt' => 'Estado Mensagem']
    )->label("Estado Mensagem"); ?>

    <div class="form-group">
        <?= Html::submitButton('Atualizar Mensagem', ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
