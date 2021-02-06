<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="gerirUsers-Container">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirUsers']); ?>

        <p class="gerirUsers-info">GERIR UTILIZADORES</p>
    </div>
    <?= Html::a('Estatisticas', ['estatisticas'], ['class' => 'btn btn-danger btn-stats-users']) ?>

    <?= GridView::widget([
        'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Utilizadores</div>',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Nome de Utilizador',
                'attribute' => 'username',
                'format' => 'text'
            ],
            'email:email',
            [
                'label' => 'Estado da conta',
                'filter' => Html::activeDropDownList($searchModel, 'status', array('10'=>'Ativa', '9'=>'Inativa', '0'=>'Banida', '1'=>'Apagada'),['class'=>'form-control','prompt' => 'Escolher estado']),
                'attribute' => 'estado',
                'format' => 'text'
            ],
            [
                'label' => 'Data de Criação',
                'attribute' => 'created_at',
                'format' => ['datetime', 'php:d-m-Y']
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],

        ],
    ]); ?>

</div>
