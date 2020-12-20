<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Contactos */

$this->title = "Mensagem ID: " . $model->idContactos;
$this->params['breadcrumbs'][] = ['label' => 'Contactos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->assunto . " (" . $model->idContactos. ')';
\yii\web\YiiAsset::register($this);
$atributos = [
    [
        'label' => 'ID',
        'value' => $model->idContactos,
    ],
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
    ],[
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

    <h3 class="info-mensagem">
        Ponto Turistico: <?= $model->assunto ?>
    </h3>

    <div class="gerirMensagensContainer">
    <?php
    echo $this->render('_form', [
        'model' => $model,
    ]);

    echo DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered detail-view detailView-gerirPontosTuristicos'],
        'attributes' => $atributos,
    ]);
    ?>

    </div>
</div>
