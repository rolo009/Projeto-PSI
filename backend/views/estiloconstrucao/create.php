<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Estiloconstrucao */

$this->title = 'Registar Estilo Construção';
$this->params['breadcrumbs'][] = ['label' => 'Registar Ponto Turistico', 'url' => ['pontosturisticos/create']];
$this->params['breadcrumbs'][] = ['label' => 'Estilos de Construção', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estiloconstrucao-create-container">
    <div class="estiloconstrucao-create">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
