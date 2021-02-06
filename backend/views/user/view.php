<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = "Gerir: " . $model->id . " (" . $model->username . ")";
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
\yii\web\YiiAsset::register($this);
$atributos = [
    [
        'label' => 'Tipo de Utilizador',
        'value' => $permissaoUser,
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
        'value' => $model->estado,
    ],
    [
        'label' => 'Data de criação',
        'value' => $model->created_at,
        'format' => ['datetime', 'php:d-m-Y']
    ]
];
?>
<div class="gerir-users-container">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]);
    echo DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered detail-view detailView-gerirUsers'],
        'attributes' => $atributos
    ]) ?>
</div>