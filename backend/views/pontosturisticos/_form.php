<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="pontosturisticos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'tm_idTipoMonumento')->dropdownList([
        $tiposMonumentosPT
    ],
        ['prompt' => 'Selecione um Tipo de Monumento']
    )->label("Tipo de Monumento"); ?>

    <?= Html::a('Gerir Tipos de Monumento', ['tipomonumento/index'], ['class' => 'btn btn-danger btn-registar-ponto-turistico']) ?>

    <?= $form->field($model, 'ec_idEstiloConstrucao')->dropdownList([
        $estiloConstrucaoPT
    ],
        ['prompt' => 'Selecione um Estilo de Contrução']
    )->label("Estilo de Contrução"); ?>

    <?= Html::a('Gerir Estilos de Construção', ['estiloconstrucao/index'], ['class' => 'btn btn-danger btn-registar-ponto-turistico']) ?>

    <?= $form->field($model, 'localidade_idLocalidade')->dropdownList([
        $localidadePT
    ],
        ['prompt' => 'Selecione uma Localidade']
    )->label("Localidade"); ?>

    <?= Html::a('Gerir Localidades', ['localidade/index'], ['class' => 'btn btn-danger btn-registar-ponto-turistico']) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])->label("Nome") ?>

    <?= $form->field($model, 'anoConstrucao')->textInput(['maxlength' => true])->label("Ano de Contrução") ?>

    <?= $form->field($model, 'horario')->textInput(['maxlength' => true])->label("Horário") ?>

    <?= $form->field($model, 'morada')->textInput(['maxlength' => true])->label("Morada") ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true])->label("Telefone") ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true])->label("Latitute") ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true])->label("Longitude") ?>
<div class="control-label">Foto</div>
    <?php
    if($model->foto != null){
        echo Html::img(Yii::$app->urlManagerAPI->baseUrl . '/img-pt/' . $model->foto, ['class' => 'img-pt-update']);
    }

    echo $form->field($modelUpload, 'imageFile')->fileInput(['options'=>['value' => $model->foto]])->label(false);
    ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true, 'rows' => 6])->label("Descrição") ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
