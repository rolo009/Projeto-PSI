<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */

$this->title = 'Criar Ponto Turisticos';
$this->params['breadcrumbs'][] = ['label' => 'Pontos Turisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontosturisticos-create">

    <h3 class="info-pt" >
        <?= "Criar Ponto Turistico" ?>
    </h3>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUpload' => $modelUpload,
        'tiposMonumentosPT' => $tiposMonumentosPT,
        'localidadePT' => $localidadePT,
        'estiloConstrucaoPT' => $estiloConstrucaoPT,
    ]) ?>

</div>
