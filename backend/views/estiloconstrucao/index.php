<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstiloconstrucaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estilos de Construção';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estiloconstrucao-index">

    <div class="gerirEstiloconstrucao-Container">

        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirEstiloconstrucao']); ?>

        <p class="gerirUsers-info">GERIR ESTILO DE CONSTRUÇÃO</p>
    </div>

    <div class="gridView-gridView-estiloconstrucao">

        <?= Html::a('Registar Estilo de Construcao', ['create'], ['class' => 'btn btn-success btn-registar-estilo-construcao']); ?>


        <?= GridView::widget([
            'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Estilos de Construção</div>',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'ID',
                    'attribute' => 'idEstiloConstrucao',
                    'format' => 'text'
                ],
                [
                    'label' => 'Estilo de Construção',
                    'attribute' => 'descricao',
                    'format' => 'text'
                ],

                ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
            ],
        ]); ?>


    </div>
</div>
