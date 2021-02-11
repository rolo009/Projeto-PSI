<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PontosturisticosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pontos Turisticos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontos-turisticos-index">

    <div class="gerirPontosTuristicos-Container">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirPontosTuristicos']); ?>
        <p class="gerirPontoTuristicos-info">GERIR PONTOS TURISTICOS</p>
    </div>


    <?= Html::a('Registar Ponto Turistico', ['create'], ['class' => 'btn btn-danger btn-registar-ponto-turistico']); ?>

    <?= GridView::widget([
        'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Pontos Turisticos</div>',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Nome',
                'attribute' => 'nome',
                'format' => 'text'
            ],
            [
                'label' => 'Estado',
                'attribute' => 'estado',
                'filter' => Html::activeDropDownList($searchModel, 'status', array('0' => 'Inativo', '1' => 'Ativo'), ['class' => 'form-control', 'prompt' => 'Escolher estado']),
                'format' => 'text'
            ],
            [

                'value' => function ($model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open icon-action-grid-view"></span>', ['view', 'id' => $model->id_pontoTuristico])

                        . '' . Html::a('<span class="glyphicon glyphicon-pencil icon-action-grid-view"></span>', ['update', 'id' => $model->id_pontoTuristico])

                        . '' . Html::a('<span class="glyphicon glyphicon-trash icon-action-grid-view"></span>', ['delete', 'id' => $model->id_pontoTuristico], ['data' => ['confirm' => Yii::t('app', 'Tem a certeza que pretende apagar este Ponto Turistico?'), 'method' => 'post',],]);

                },
                'format' => 'raw',

            ],
        ],
    ]); ?>

</div>
