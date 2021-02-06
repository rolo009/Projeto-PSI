<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipomonumento */

$this->title = 'Atualizar Tipo de Monumento: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Monumentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipomonumento-update-container">
<div class="tipomonumento-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
