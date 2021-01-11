<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Localidade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localidade-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'nomeLocalidade')->textInput(['maxlength' => true])->label("Localidade") ?>

    <?= $form->field($modelUpload, 'imageFile')->fileInput()->label("Foto")?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
