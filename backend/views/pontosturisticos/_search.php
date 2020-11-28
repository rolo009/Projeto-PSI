<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PontosturisticosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pontosturisticos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_pontoTuristico') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'anoConstrucao') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'tm_idTipoMonumento') ?>

    <?php // echo $form->field($model, 'ec_idEstiloConstrucao') ?>

    <?php // echo $form->field($model, 'localidade_idLocalidade') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
