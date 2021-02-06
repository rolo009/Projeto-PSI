<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Localidade */

$this->title = 'Registar Localidade';
$this->params['breadcrumbs'][] = ['label' => 'Registar Ponto Turistico', 'url' => ['pontosturisticos/create']];
$this->params['breadcrumbs'][] = ['label' => 'Localidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidade-create-container">
    <div class="localidade-create">
        <?= $this->render('_form', [
            'model' => $model,
            'modelUpload' => $modelUpload,
        ]) ?>
    </div>
</div>
