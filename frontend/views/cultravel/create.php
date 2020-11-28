<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */

$this->title = 'Create pontosturisticos';
$this->params['breadcrumbs'][] = ['label' => 'pontosturisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontosturisticos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
