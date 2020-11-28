<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */
/* @var $form yii\widgets\ActiveForm */

$tiposMonumentos = \app\models\Tipomonumento::find()
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
    ->column();
?>

<div class="pontosturisticos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true])->label("Nome") ?>

    <?= $form->field($model, 'anoConstrucao')->textInput(['maxlength' => true])->label("Ano de Contrução") ?>

    <?= $form->field($model, 'foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_idTipoMonumento')->dropdownList([
        $tiposMonumentos
    ],
        ['prompt' => 'Selecione um Tipo de Monumento']
    )->label("Tipo de Monumento"); ?>

    <?= $form->field($model, 'ec_idEstiloConstrucao')->dropdownList([
        $estiloConstrucao
    ],
        ['prompt' => 'Selecione um Estilo de Contrução']
    )->label("Estilo de Contrução"); ?>

    <?= $form->field($model, 'localidade_idLocalidade')->dropdownList([
        $localidade
    ],
        ['prompt' => 'Selecione uma Localidade']
    )->label("Localidade"); ?>

    <?= $form->field($model, 'descricao')->textarea(['maxlength' => true, 'rows' => 6])->label("Descrição") ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
