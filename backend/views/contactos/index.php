<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contactos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contactos-index">

    <div class="gerirMensagens-Container">
        <?= Html::img('@web/imagens/logo/seta-logo.png', ['class' => 'logo-gerirMensagens']); ?>

        <p class="gerirUsers-info">GERIR MENSAGENS</p>
    </div>

    <?= GridView::widget([
        'summary' => '<div class="summary">Mostra <b>{begin}-{end}</b> de <b>{totalCount}</b> Mensagem</div>',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered gridView-backend'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Email',
                'attribute' => 'email',
                'format' => 'email'
            ],
            [
                'label' => 'Assunto',
                'attribute' => 'assunto',
                'format' => 'text'
            ],
            [
                'label' => 'Estado da Mensagem',
                'filter' => ['0' => 'Mensagens não Lidas', '1' => 'Mensagens Lidas'],
                'attribute' => 'status',
                'format' => 'text'
            ],
            [
                'label' => 'Data',
                'attribute' => 'dataEnvioMensagem',
                'format' => 'datetime'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
