<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstiloconstrucaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estilos de Construção';
$this->params['breadcrumbs'][] = ['label' => 'Registar Ponto Turistico', 'url' => ['pontosturisticos/create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estiloconstrucao-index">

    <div class="gerirEstiloconstrucao-Container">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirEstiloconstrucao']); ?>
        <p class="gerirUsers-info">GERIR ESTILOS DE CONSTRUÇÃO</p>
    </div>

    <?= Html::a('Registar Estilo de Construcao', ['create'], ['class' => 'btn btn-danger btn-registar-estilo-construcao']); ?>

    <?php

    ?>
    <?= GridView::widget([
        'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Estilos de Construção</div>',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Estilo de Construção',
                'attribute' => 'descricao',
                'format' => 'text'
            ],

            [

                'value' => function ($model)
                {
                    return Html::a('<span class="glyphicon glyphicon-pencil icon-action-grid-view"></span>', ['update', 'id' => $model->idEstiloConstrucao])

                        .''.Html::a('<span class="glyphicon glyphicon-trash icon-action-grid-view"></span>', ['delete', 'id' => $model->idEstiloConstrucao], ['data' => ['confirm' => Yii::t('app', 'Tem a certeza que pretende apagar este Estilo de construção?'),'method' => 'post',],]);

                },
                'format'=>'raw',

            ],

        ],
    ]); ?>

</div>
