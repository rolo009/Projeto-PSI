<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\widgets\DetailView;
use practically\chartjs\Chart;
use scotthuangzl\googlechart\GoogleChart;
use kartik\export\ExportMenu;


/* @var $this yii\web\View */
/* @var $model app\models\Pontosturisticos */

$this->title = "Gerir: " . $pontoTuristico->nome;
$this->params['breadcrumbs'][] = ['label' => 'Pontos Turisticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $pontoTuristico->nome;
\yii\web\YiiAsset::register($this);

if ($pontoTuristico->anoConstrucao == null) {
    $pontoTuristico->anoConstrucao = "Sem informação disponivel";
}

if ($pontoTuristico->horario == null) {
    $pontoTuristico->horario = "Sem informação disponivel";
}

if ($pontoTuristico->morada == null) {
    $pontoTuristico->morada = "Sem informação disponivel";
}

if ($pontoTuristico->telefone == null) {
    $pontoTuristico->telefone = "Sem informação disponivel";
}

if ($pontoTuristico->ecIdEstiloConstrucao == null) {
    $estiloConstrucao = "Sem informação disponivel";
}else{
    $estiloConstrucao =  $pontoTuristico->ecIdEstiloConstrucao->descricao;
}


$atributos = [
    [
        'label' => 'Foto',
        'value' => '@web/imagens/img-pt/' . $pontoTuristico->foto,
        'format' => ['image', ['height' => '200']],
    ],
    [
        'label' => 'Estado',
        'value' => $pontoTuristico->estado,
    ],
    [
        'label' => 'Ano de Construção',
        'value' => $pontoTuristico->anoConstrucao
    ],
    [
        'label' => 'Localidade',
        'value' => $pontoTuristico->localidadeIdLocalidade->nomeLocalidade
    ],
    [
        'label' => 'Morada',
        'value' => $pontoTuristico->morada
    ],
    [
        'label' => 'Telefone',
        'value' => $pontoTuristico->telefone
    ],
    [
        'label' => 'Estilo de Construção',
        'value' => $estiloConstrucao
    ],
    [
        'label' => 'Tipo de Monumento',
        'value' => $pontoTuristico->tmIdTipoMonumento->descricao
    ],
    [
        'label' => 'Rating',
        'value' => $mediaRatings
    ],
    [
        'label' => 'Horário',
        'value' => $pontoTuristico->horario
    ],

    [
        'label' => 'Descrição',
        'value' => $pontoTuristico->descricao
    ],
];


?>
<div class="view-pontos-turisticos-container">
    <p>
        <?= Html::a('Atualizar Ponto Turistico', ['update', 'id' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-danger']) ?>

        <?= Html::a('Apagar Ponto Turistico', ['delete', 'id' => $pontoTuristico->id_pontoTuristico], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar o ponto turistico?',
                'method' => 'post',
            ],
        ]) ?>
        <?php

        if ($pontoTuristico->status == 0) {
            echo Html::a('Tornar Ativo', ['update-pt-ativo', 'id' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-danger btn-visivel pull-right']);
        } elseif ($pontoTuristico->status == 1) {
            echo Html::a('Tornar Inativo', ['update-pt-inativo', 'id' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-danger btn-visivel pull-right']);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $pontoTuristico,
        'options' => ['class' => 'table table-striped table-bordered detail-view detailView-gerirPontosTuristicos'],
        'attributes' => $atributos
    ]);
    ?>

<h3 class="estatisticas-ponto-turistico">
    <?= GoogleChart::widget(array('visualization' => 'ColumnChart',
        'data' => array(
            array('Tarefa', 'Nº de Utilizadores'),
            array('Favoritos', $favoritosContador),
            array('Visitados', $visitadosContador),
        ),
        'options' => ['title' => 'Estatisticas',
            'colors'=> ['#f6504b']]
        ));

    ?>
    </div>
</h3>

