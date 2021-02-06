<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Estiloconstrucao */

$this->title = 'Atualizar Estilo de Construção: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Estilos de Construção', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estiloconstrucao-update-container">
    <div class="estiloconstrucao-update">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
