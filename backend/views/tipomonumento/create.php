<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipomonumento */

$this->title = 'Registar Tipo Monumento';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Monumentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipomonumento-create">

    <h3 class="info-pt" >
        <?= "Criar Tipo de Monumento" ?>
    </h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
