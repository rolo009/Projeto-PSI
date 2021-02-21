<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

$i = 0;

$this->title = 'Favoritos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="favourite-container">
    <?php
    foreach ($ptFavoritos as $ptFavorito) {
        ?>

        <div class="card favourite-ponto-interesse-card">

            <?php
            echo Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-pt/' . $ptFavorito->foto, ['class' => 'img-pi-favoritos']);
            echo Html::a(FA::icon("star", ['class' => 'icon-action-pt']), ['cultravel/remover-favoritos', 'pesquisa' => $this->title, 'idPontoTuristico' => $ptFavorito->id_pontoTuristico, 'url' => Yii::$app->controller->getRoute()], ['class' => 'btn btn-danger btn-favoritos-remover']);

            ?>
            <h5>
                <?= $ptFavorito->nome ?>
            </h5>
            <div class="btn-saber-mais">
                <?= Html::a('Saber Mais', ['cultravel/ponto-interesse-details', 'pesquisa' => $ptFavorito->localidadeIdLocalidade->nomeLocalidade, 'id' => $ptFavorito->id_pontoTuristico], ['class' => 'btn btn-danger btn-pi-info']) ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>