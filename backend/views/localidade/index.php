<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalidadeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Localidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidade-index">

    <div class="gerirLocalidade-Container">

        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirLocalidade']); ?>

        <p class="gerirUsers-info">GERIR LOCALIDADE</p>
    </div>

    <div class="gridView-gridView-localidade">

        <?= Html::a('Registar Localidade', ['create'], ['class' => 'btn btn-success btn-registar-localidade']); ?>


        <?= GridView::widget([
            'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Localidades</div>',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'ID',
                    'attribute' => 'id_localidade',
                    'format' => 'text'
                ],
                [
                    'label' => 'Localidade',
                    'attribute' => 'nomeLocalidade',
                    'format' => 'text'
                ],

                ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                ],
        ]); ?>


    </div>
</div>
