<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Localidade */

$this->title = 'Atualizar Localidade: ' . $model->id_localidade;
$this->params['breadcrumbs'][] = ['label' => 'Localidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_localidade, 'url' => ['view', 'id' => $model->id_localidade]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="localidade-update">

    <h3 class="info-pt" >
        <?= "Atualizar Loclaidade: ". $model->nomeLocalidade ?>
    </h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
