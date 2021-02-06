<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Pontosturisticos */

$this->title = 'Atualizar: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Pontos Turisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontos-turisticos-update-container">
    <div class="pontosturisticos-update">

        <?= $this->render('_form', [
            'model' => $model,
            'modelUpload' => $modelUpload,
            'tiposMonumentosPT' => $tiposMonumentosPT,
            'localidadePT' => $localidadePT,
            'estiloConstrucaoPT' => $estiloConstrucaoPT,
        ]) ?>

    </div>
</div>
