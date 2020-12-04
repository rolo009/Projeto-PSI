<?php

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
    <?= Html::a('Estatisticas', ['estatisticas'], ['class' => 'btn btn-primary']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ID',
                'attribute' => 'id',
                'format' => 'text'
            ],
            [
                'label' => 'Nome de Utilizador',
                'attribute' => 'username',
                'format' => 'text'
            ],
            'email:email',
            [
                'label' => 'Estado da conta',
                'filter' => ['0' => 'Conta Banida', '9' => 'Conta Inactiva', '10' => 'Conta Ativa'],
                'attribute' => 'status',
                'format' => 'text'
            ],
            [
                'label' => 'Data de Criação',
                'attribute' => 'created_at',
                'format' => 'datetime'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
