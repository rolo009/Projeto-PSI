<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */

$this->title = 'Atualizar: ' . $model->nome ;
$this->params['breadcrumbs'][] = ['label' => 'Pontos Turisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pontoTuristico, 'url' => ['view', 'id' => $model->id_pontoTuristico]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="pontosturisticos-update">

    <h3 class="info-pt" >
        <?= "Atualizar Ponto Turistico: ". $model->nome ?>
    </h3>

    <?= $this->render('_form', [
        'model' => $model,
        'tiposMonumentosPT' => $tiposMonumentosPT,
        'localidadePT' => $localidadePT,
        'estiloConstrucaoPT' => $estiloConstrucaoPT,
    ]) ?>

</div>
