<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contactos */

$this->title = "Mensagem: " . $model->assunto;
$this->params['breadcrumbs'][] = ['label' => 'Contactos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->assunto;
\yii\web\YiiAsset::register($this);
$atributos = [
    [
        'label' => 'Data de Envio',
        'value' => $model->dataEnvioMensagem,
    ],
    [
        'label' => 'Data de Leitura',
        'value' => $model->dataResposta,
    ],
    [
        'label' => 'Estado da mensagem',
        'value' => $estadoMensagem,
    ], [
        'label' => 'Nome',
        'value' => $model->nome,
    ],
    [
        'label' => 'Email',
        'value' => $model->email,
    ],
    [
        'label' => 'Assunto',
        'value' => $model->assunto,
    ],
    [
        'label' => 'Mensagem',
        'value' => $model->mensagem,
    ],
]
?>
<div class="contactos-view">

    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);

    echo DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered detail-view detailView-gerirContactos'],
        'attributes' => $atributos,
    ]);
    ?>

</div>

