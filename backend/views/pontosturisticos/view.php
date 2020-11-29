<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */

$this->title = "Gerir: ".$model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Pontos Turisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$atributos = [
    [
        'label' => 'Foto',
        'value' => $model->foto,
        'format' => ['image',['width'=>'150','height'=>'150']],
    ],
    [
        'label' => 'ID',
        'value' => $model->id_pontoTuristico,
    ],
    [
        'label' => 'Ano de Construção',
        'value' => $model->anoConstrucao
    ],
    [
        'label' => 'Localidade',
        'value' => $localidade->nomeLocalidade
    ],
    [
        'label' => 'Estilo de Construção',
        'value' => $estiloConstrucao->descricao
    ],
    [
        'label' => 'Tipo de Monumento',
        'value' => $tipoMonumento->descricao
    ],
    [
        'label' => 'Rating',
        'value' => $mediaRatings
    ],
    [
        'label' => 'Descrição',
        'value' => $model->descricao
    ],
];
?>
<div class="pontosturisticos-view">

    <h3 class="info-user">
        Ponto Turistico: <?= $model->nome ?>
    </h3>
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_pontoTuristico], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id_pontoTuristico], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar o ponto turistico?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="gerirPontosTuristicosContainer">
    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered detail-view detailView-gerirPontosTuristicos'],
        'attributes' => $atributos
    ]) ?>
</div>
    <h3 class="estatisticas-ponto-turistico">

    </h3>

</div>
