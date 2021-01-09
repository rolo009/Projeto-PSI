<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Estiloconstrucao */

$this->title = 'Atualizar Estilo de Construção: ' . $model->idEstiloConstrucao;
$this->params['breadcrumbs'][] = ['label' => 'Estilos de Construção', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idEstiloConstrucao, 'url' => ['view', 'id' => $model->idEstiloConstrucao]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="estiloconstrucao-update">

    <h3 class="info-pt" >
        <?= "Atualizar Estilo de Construção: ". $model->descricao ?>
    </h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
