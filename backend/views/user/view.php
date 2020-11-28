<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = "Gerir: ".$model->id. " (".$model->username.")";
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id. " (".$model->username.")";
\yii\web\YiiAsset::register($this);
$atributos = [
    [
        'label' => 'ID Utilizador',
        'value' => $model->id,
    ],
    [
        'label' => 'Nome de Utilizador',
        'value' => $model->username,
    ],
    [
        'label' => 'Nome',
        'value' => $userProfile->primeiroNome . " " . $userProfile->ultimoNome,
    ],
    [
        'label' => 'Data de Nascimento',
        'value' => $userProfile->dtaNascimento,
    ],
    [
        'label' => 'Sexo',
        'value' => $userProfile->sexo,
    ],
    [
        'label' => 'Email',
        'value' => $model->email,
    ],
    [
        'label' => 'Estado da Conta',
        'value' => $estadoUser,
    ],
    [
        'label' => 'Data de criação',
        'value' => $model->created_at,
    ]
];
?>
<div class="user-view">

    <h3 class="info-user">
        Utilizador: <?= $model->username ?>
    </h3>

    <p>
        <?= Html::a('Atualizar Estado', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar este utilizador?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="gerirUsersContainer">
        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-striped table-bordered detail-view detailView-gerirUsers'],
            'attributes' => $atributos
        ]) ?>
    </div>
</div>
