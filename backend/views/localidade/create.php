<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Localidade */

$this->title = 'Registar Localidade';
$this->params['breadcrumbs'][] = ['label' => 'Localidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidade-create">

    <h3 class="info-pt" >
        <?= "Registar Localidade" ?>
    </h3>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUpload' => $modelUpload,
    ]) ?>

</div>
