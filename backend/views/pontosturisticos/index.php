<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PontosturisticosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pontos Turisticos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontosturisticos-index">

    <div class="gerirUsers-Container">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirPontosTuristicos']); ?>

        <p class="gerirUsers-info">GERIR PONTOS TURISTICOS</p>
    </div>

<div class="gridView-pontosTuristicos">
    <?php
    echo Html::a('Registar Ponto Turistico', ['create'], ['class' => 'btn btn-success btn-registar-ponto-turistico'])

    ?>

    <?= GridView::widget([
        'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Pontos Turisticos</div>',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ID',
                'attribute' => 'id_pontoTuristico',
                'format' => 'text'
            ],
            [
                'label' => 'Nome',
                'attribute' => 'nome',
                'format' => 'text'
            ],
            [
                'label' => 'Estado',
                'attribute' => 'status',
                'filter' => ['0' => 'Inativo', '1' => 'Ativo'],
                'format' => 'text'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
