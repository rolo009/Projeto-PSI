<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Localidade */

$this->title = 'Atualizar Localidade: ' . $model->nomeLocalidade;
$this->params['breadcrumbs'][] = ['label' => 'Registar Ponto Turistico', 'url' => ['pontosturisticos/create']];
$this->params['breadcrumbs'][] = ['label' => 'Localidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidade-update-container">
    <div class="localidade-update">
        <?= $this->render('_form', [
            'model' => $model,
            'modelUpload' => $modelUpload,
        ]) ?>
    </div>
</div>
