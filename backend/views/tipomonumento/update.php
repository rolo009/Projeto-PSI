<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipomonumento */

$this->title = 'Atualizar Tipo de Monumento: ' . $model->idTipoMonumento;
$this->params['breadcrumbs'][] = ['label' => 'Tipomonumentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTipoMonumento, 'url' => ['view', 'id' => $model->idTipoMonumento]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="tipomonumento-update">

    <h3 class="info-pt" >
        <?= "Atualizar Tipo de Monumento: ". $model->descricao ?>
    </h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
