<?php

use rmrevin\yii\fontawesome\FA;

?>

<div class="pontos-interesse-details-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                    <div class="card card-ponto-interesse-details">
                        <div class="card-body">
                            <h5 class="card-title">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pt-details-nome">
                                            <?= $pontoTuristico->nome ?>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pt-details-options">
                                            <?php
                                            if (\Yii::$app->user->can('editarPi')) {
                                                ?>
                                            <a href="#" class="btn btn-warning"><?= FA::icon("wrench") ?></a>
                                            <?php
                                            }
                                            ?>
                                            <a href="#" class="btn btn-warning"><?= FA::icon("star") ?></a>
                                            <a href="#" class="btn btn-warning"><?= FA::icon("check-circle") ?></a>
                                        </div>
                                    </div>
                            </h5>
                        </div>
                        <img class="card-img-top" src="castelo-de-leiria.jpg" alt="Img-PT">
                    </div>
            </div>
            <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6 info-pt">
                    <p class="details-pt-title">Tipo Monumento</p>
                    <p class="details-pt"><?=$tipoMonumento->descricao ?></p>
                    <p class="details-pt-title">Estilo de Construção</p>
                    <p class="details-pt"><?=$estiloMonumento->descricao ?></p>
                    <p class="details-pt-title">Ano de Construção</p>
                    <p class="details-pt"><?=$pontoTuristico->anoConstrucao ?></p>
                    <p class="details-pt-title">Localidade</p>
                    <p class="details-pt"><?=$localidadeMonumento->nomeLocalidade ?></p>
                    <p class="details-pt-title">Rating</p>
                    <p class="details-pt">
                        <span class="fa fa-star checked"></span>
                        <?=$ratingMonumento?>/5
                    </p>
            </div>
        </div>
    </div>
    <div>
        <div class="w-100"></div>
        <div class="col desc-container">
            <h3>Descrição</h3>
            <?=$pontoTuristico->descricao ?>
        </div>

    </div>
</div>

