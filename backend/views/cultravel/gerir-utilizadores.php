<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Gerir Utilizadores';
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'username',
            'email:email',
            'status',
            'created_at:datetime',
            //'updated_at',
            //'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
