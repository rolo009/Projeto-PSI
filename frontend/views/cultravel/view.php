<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */

$this->title = $model->id_pontoTuristico;
$this->params['breadcrumbs'][] = ['label' => 'Pontosturisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pontosturisticos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_pontoTuristico], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_pontoTuristico], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pontoTuristico',
            'nome',
            'anoConstrucao',
            'descricao',
            'foto',
            'tm_idTipoMonumento',
            'ec_idEstiloConstrucao',
            'localidade_idLocalidade',
        ],
    ]) ?>

</div>
