<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */

$this->title = 'Update Pontosturisticos: ' . $model->id_pontoTuristico;
$this->params['breadcrumbs'][] = ['label' => 'Pontosturisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pontoTuristico, 'url' => ['view', 'id' => $model->id_pontoTuristico]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pontosturisticos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
