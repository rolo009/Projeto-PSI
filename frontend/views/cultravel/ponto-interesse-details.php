<?php

use kartik\rating\StarRating;
use rmrevin\yii\fontawesome\FA;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Detalhes: ' . $pontoTuristico->nome;
?>

<div class="pontos-interesse-details-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8 col-sm-7 col-md-7 col-lg-7">
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
                                        if (!Yii::$app->user->isGuest) {
                                            if ($favoritoStatus == true) {
                                                echo Html::a(FA::icon("star"), ['cultravel/remover-favoritos', 'idPontoTuristico' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-warning btn-remover-favoritos']);
                                            } elseif ($favoritoStatus == false) {
                                                echo Html::a(FA::icon("star-o"), ['cultravel/adicionar-favoritos', 'idPontoTuristico' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-warning btn-adicionar-favoritos']);
                                            }

                                            if ($visitadoStatus == true) {
                                                echo Html::a(FA::icon("check-circle")->size(FA::SIZE_LARGE), ['cultravel/remover-visitados', 'idPontoTuristico' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-warning btn-remover-visitados']);
                                            } elseif ($visitadoStatus == false) {
                                                echo Html::a(FA::icon("check-circle-o")->size(FA::SIZE_LARGE), ['cultravel/adicionar-visitados', 'idPontoTuristico' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-warning btn-adicionar-visitados']);
                                            }
                                        }

                                        ?></div>
                                </div>
                        </h5>
                    </div>
                    <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-pt/'. $pontoTuristico->foto, ['class' => 'card-img-top']); ?>

                </div>
            </div>
            <div class="col-xs-8 col-sm-5 col-md-5 col-lg-5 info-pt">
                <?php
                if ($tipoMonumento != null) { ?>
                    <p class="details-pt-title">TIPO</p>
                    <p class="details-pt"><?= $tipoMonumento ?></p>
                    <?php
                }
                if ($estiloMonumento != null) { ?>
                    <p class="details-pt-title">ESTILO DE CONSTRUÇÃO</p>
                    <p class="details-pt"><?= $estiloMonumento ?></p>
                    <?php
                }
                if ($pontoTuristico->anoConstrucao != null) { ?>
                    <p class="details-pt-title">ANO DE CONSTRUÇAO</p>
                    <p class="details-pt"><?= $pontoTuristico->anoConstrucao ?></p>
                    <?php
                }
                ?>
                <p class="details-pt-title">RATING</p>
                <p class="details-pt">
                    <span class="fa fa-star checked"></span>
                    <?= $ratingMonumento ?>/5
                </p>
            </div>
        </div>
    </div>
    <div>
        <div class="w-100"></div>

        <div class="col desc-container">
            <h3>Descrição</h3>
            <?= $pontoTuristico->descricao ?>

            <div id="mais-stats" class="mais-stats">
                <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">

                    <?php
                    if ($localidadeMonumento->nomeLocalidade != null) { ?>
                        <p class="details-pt-title">LOCALIDADE</p>
                        <p class="details-pt"><?= $localidadeMonumento->nomeLocalidade ?></p>
                        <?php
                    }

                    if ($pontoTuristico->morada != null) { ?>
                        <p class="details-pt-title">MORADA</p>
                        <p class="details-pt"><?= $pontoTuristico->morada ?></p>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
                    <?php

                    if ($pontoTuristico->horario != null) { ?>
                        <p class="details-pt-title">HORÁRIO</p>
                        <p class="details-pt"><?= $pontoTuristico->horario ?></p>
                        <?php
                    }

                    if ($pontoTuristico->telefone != null) { ?>
                        <p class="details-pt-title">TELEFONE</p>
                        <p class="details-pt"><?= $pontoTuristico->telefone ?></p>
                        <?php
                    }
                    ?>

                </div>
                <div class="rating-container">
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        $form = ActiveForm::begin();
                        echo $form->field($rating, 'classificacao')->widget(StarRating::classname(), [
                            'pluginOptions' => [
                                'min' => 1,
                                'max' => 5,
                                'step' => 1,
                                'size' => 'lg',
                            ],
                        ])->label("Rating");
                        echo Html::submitButton('Avaliar', ['class' => 'btn btn-warning']);

                    ActiveForm::end();
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>

