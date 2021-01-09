<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Localidade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localidade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeLocalidade')->textInput(['maxlength' => true])->label("Localidade") ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
