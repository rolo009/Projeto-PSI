<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
$i = 0;

$this->title = 'Favoritos';

?>

<div class="favourite-container">
    <?php
    foreach ($ptFavoritos as $ptFavorito) {
            ?>
        <div class="card favourite-ponto-interesse">
            <div class="favorite-header">
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="localidade-pi-container">
                        <?php
                        echo $ptFavorito->nome
                        ?>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="favourite-options">
                        <?= Html::a(FA::icon("star"), ['cultravel/remover-favoritos', 'idPontoTuristico' =>$ptFavorito->id_pontoTuristico], ['class' => 'btn btn-warning btn-remover-favoritos']); ?>
                    </div>
                </div>
            </div>
            <div class="favorite-body">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-pt/'. $ptFavorito->foto, ['class' => 'img-pi-favoritos']); ?>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="nome-pi-container">
                        <?php  echo $ptFavorito->localidade_idLocalidade;
                        ?>
                    </div>
                </div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                    <div class="btn-pi">
                        <?= Html::a(''.FA::icon("angle-double-right"), ['cultravel/ponto-interesse-details', 'id' => $ptFavorito->id_pontoTuristico], ['class' => 'btn btn-outline-dark']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
    ?>
</div>