<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TipomonumentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de Monumentos';
$this->params['breadcrumbs'][] = ['label' => 'Registar Ponto Turistico', 'url' => ['pontosturisticos/create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipomonumento-index">

    <div class="gerirTipomonumento-Container">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirTipomonumento']); ?>
        <p class="gerirTipoMonumento-info">GERIR TIPO DE MONUMENTO</p>
    </div>

    <?= Html::a('Registar Tipo de Monumento', ['create'], ['class' => 'btn btn-danger btn-registar-tipo-monumento']); ?>


    <?= GridView::widget([
        'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Tipos de Monumento</div>',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Tipo de Monumento',
                'attribute' => 'descricao',
                'format' => 'text'
            ],

            [
                'value' => function ($model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil icon-action-grid-view"></span>', ['update', 'id' => $model->idTipoMonumento])

                        . '' . Html::a('<span class="glyphicon glyphicon-trash icon-action-grid-view"></span>', ['delete', 'id' => $model->idTipoMonumento], ['data' => ['confirm' => Yii::t('app', 'Tem a certeza que pretende apagar este Tipo de Monumento?'), 'method' => 'post',],]);

                },
                'format' => 'raw',

            ],],
    ]); ?>


</div>
