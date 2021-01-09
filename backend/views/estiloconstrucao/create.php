<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Estiloconstrucao */

$this->title = 'Registar Estilo Construção';
$this->params['breadcrumbs'][] = ['label' => 'Estilos de Construção', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estiloconstrucao-create">

    <h3 class="info-pt" >
        <?= "Registar Estilo de Construção" ?>
    </h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
