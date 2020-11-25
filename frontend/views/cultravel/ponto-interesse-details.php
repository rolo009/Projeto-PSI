<?php

use kartik\rating\StarRating;
use rmrevin\yii\fontawesome\FA;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

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
                                            <?= Html::a(FA::icon("star"), ['cultravel/adicionar-favoritos', 'idPontoTuristico' =>$pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-warning']) ?>
                                            <a href="#" class="btn btn-warning"><?= FA::icon("check-circle") ?></a>
                                        </div>
                                    </div>
                            </h5>
                        </div>
                        <?=Html::img('@web/'.$pontoTuristico -> foto, ['class' => 'card-img-top']); ?>
                    </div>
            </div>
            <div class="col-xs-8 col-sm-6 col-md-6 col-lg-6 info-pt">
                    <p class="details-pt-title">TIPO DE MONUMENTO</p>
                    <p class="details-pt"><?=$tipoMonumento->descricao ?></p>
                    <p class="details-pt-title">ESTILO DE CONSTRUÇÃO</p>
                    <p class="details-pt"><?=$estiloMonumento->descricao ?></p>
                    <p class="details-pt-title">ANO DE CONSTRUÇAO</p>
                    <p class="details-pt"><?=$pontoTuristico->anoConstrucao ?></p>
                    <p class="details-pt-title">LOCALIDADE</p>
                    <p class="details-pt"><?=$localidadeMonumento->nomeLocalidade ?></p>
                    <p class="details-pt-title">RATING</p>
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
        <div>
            <?php
            $form = ActiveForm::begin();

            echo $form->field($rating, 'classificacao')->widget(StarRating::classname(), [
                'pluginOptions' => [
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                    'size' => 'lg',
                ],
            ]);
            ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

