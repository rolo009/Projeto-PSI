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

    <?php
    if($model->foto != null){
        echo Html::img('imagens/img-localidade/' . $model->foto, ['class' => 'img-pt-update']);
    }

    echo $form->field($modelUpload, 'imageFile')->fileInput(['options'=>['value' => $model->foto]])->label(false);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
