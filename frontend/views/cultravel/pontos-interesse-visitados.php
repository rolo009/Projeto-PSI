<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

$this->title = $localidade->nomeLocalidade;
$this->params['breadcrumbs'][] = ['label' => 'Visitados', 'url' => ['cultravel/visitados']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontos-interesse-visitados-container">
    <div>
        <?php
        $localidade->nomeLocalidade;
        ?>
    </div>
    <?php
    foreach ($ptVisitados as $ptVisitado) {
        ?>
        <div class="card card-pontos-interesse-visitados">
            <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-pt/'. $ptVisitado->foto, ['class' => 'img-pi-card-pt-visitados']); ?>
            <?= Html::a(FA::icon("check-circle", ['class' => 'icon-action-pt']), ['cultravel/remover-visitados', 'pesquisa' => $this->title, 'idPontoTuristico' => $ptVisitado->id_pontoTuristico, 'url' => Yii::$app->controller->getRoute()], ['class' => 'btn btn-danger btn-remover-visitados']);?>

            <h5>
                <?= $ptVisitado->nome ?>
            </h5>
            <div>
                <?= Html::a('Saber Mais', ['cultravel/ponto-interesse-details', 'pesquisa' => $this->title, 'id' => $ptVisitado->id_pontoTuristico], ['class' => 'btn btn-danger btn-pi-visitado-info']) ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>