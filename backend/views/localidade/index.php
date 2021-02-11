<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalidadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Localidades';
$this->params['breadcrumbs'][] = ['label' => 'Registar Ponto Turistico', 'url' => ['pontosturisticos/create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidade-index">

    <div class="gerirLocalidade-Container">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirLocalidade']); ?>
        <p class="gerirUsers-info">GERIR LOCALIDADE</p>
    </div>

    <?= Html::a('Registar Localidade', ['create'], ['class' => 'btn btn-danger btn-registar-localidade']); ?>

    <?= GridView::widget([
        'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Localidades</div>',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Localidade',
                'attribute' => 'nomeLocalidade',
                'format' => 'text'
            ],

            [

                'value' => function ($model)
                {
                    return Html::a('<span class="glyphicon glyphicon-pencil icon-action-grid-view"></span>', ['update', 'id' => $model->id_localidade])

                        .''.Html::a('<span class="glyphicon glyphicon-trash icon-action-grid-view"></span>', ['delete', 'id' => $model->id_localidade], ['data' => ['confirm' => Yii::t('app', 'Tem a certeza que pretende apagar esta Localidade?'),'method' => 'post',],]);

                },
                'format'=>'raw',

            ],        ],
    ]); ?>


</div>
</div>
