<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */

$this->title = 'Registar Ponto Turistico';
$this->params['breadcrumbs'][] = ['label' => 'Pontos Turisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontos-turisticos-create-container">
    <div class="pontosturisticos-create">

        <?= $this->render('_form', [
            'model' => $model,
            'modelUpload' => $modelUpload,
            'tiposMonumentosPT' => $tiposMonumentosPT,
            'localidadePT' => $localidadePT,
            'estiloConstrucaoPT' => $estiloConstrucaoPT,
        ]) ?>

    </div>
</div>
