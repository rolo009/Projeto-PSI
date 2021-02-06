<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipomonumento */

$this->title = 'Registar Tipo Monumento';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Monumentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipomonumento-create-container">
    <div class="tipomonumento-create">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
