<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */
/* @var $form yii\widgets\ActiveForm */

/*$tiposMonumentos = \app\models\Tipomonumento::find()
    ->select(['descricao'])
    ->indexBy('idTipoMonumento')
    ->column();

$estiloConstrucao = \app\models\Estiloconstrucao::find()
    ->select(['descricao'])
    ->indexBy('idEstiloConstrucao')
    ->column();

$localidade = \app\models\Localidade::find()
    ->select(['nomeLocalidade'])
    ->indexBy('id_localidade')
    ->column();*/
?>

<div class="pontosturisticos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'tm_idTipoMonumento')->dropdownList([
        $tiposMonumentosPT
    ],
        ['prompt' => 'Selecione um Tipo de Monumento']
    )->label("Tipo de Monumento"); ?>

    <?= Html::a('Registar Tipo Monumento', ['cultravel/registar-tipo-monumento'], ['class' => 'btn btn-success btn-registar-ponto-turistico']) ?>

    <?= $form->field($model, 'ec_idEstiloConstrucao')->dropdownList([
        $estiloConstrucaoPT
    ],
        ['prompt' => 'Selecione um Estilo de Contrução']
    )->label("Estilo de Contrução"); ?>

    <?= Html::a('Registar Estilo de Construção', ['cultravel/registar-estilo-construcao'], ['class' => 'btn btn-success btn-registar-ponto-turistico']) ?>

    <?= $form->field($model, 'localidade_idLocalidade')->dropdownList([
        $localidadePT
    ],
        ['prompt' => 'Selecione uma Localidade']
    )->label("Localidade"); ?>

    <?= Html::a('Registar Localidade', ['cultravel/registar-localidade'], ['class' => 'btn btn-success btn-registar-ponto-turistico']) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])->label("Nome") ?>

    <?= $form->field($model, 'anoConstrucao')->textInput(['maxlength' => true])->label("Ano de Contrução") ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true])->label("Latitute") ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true])->label("Longitude") ?>

    <?= $form->field($modelUpload, 'imageFile')->fileInput()?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true, 'rows' => 6])->label("Descrição") ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
