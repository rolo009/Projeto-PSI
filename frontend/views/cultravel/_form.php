<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pontosturisticos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anoConstrucao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_idTipoMonumento')->textInput() ?>

    <?= $form->field($model, 'ec_idEstiloConstrucao')->textInput() ?>

    <?= $form->field($model, 'localidade_idLocalidade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
