<?php

use kartik\rating\StarRating;
use rmrevin\yii\fontawesome\FA;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = $pontoTuristico->nome;
$this->params['breadcrumbs'][] = ['label' => $pesquisa, 'url' => ['cultravel/pontos-interesse', 'pesquisa' => $pesquisa]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pontos-interesse-details-container">
    <!-- Card Imagem Ponto Turistico -->

    <div class="row">
        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 pt-details-nome">
            <?= $pontoTuristico->nome ?>
            <?= StarRating::widget([
                'name' => 'rating_20',
                'value' => $ratingMonumento,
                'pluginOptions' => [
                    'readonly' => true,
                    'showClear' => false,
                    'step' => 0.1,
                    'showCaption' => false,
                    'size' => 's',
                ],
            ]);
            ?>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 pt-details-options">
            <?php
            if (!Yii::$app->user->isGuest) {
                if ($favoritoStatus == true) {
                    echo Html::a(FA::icon("star", ['class' => 'icon-action-pt']), ['cultravel/remover-favoritos', 'idPontoTuristico' => $pontoTuristico->id_pontoTuristico, 'pesquisa' => $pesquisa, 'url' => Yii::$app->controller->getRoute()], ['class' => 'btn btn-danger btn-acao btn-remover-favoritos']);
                } elseif ($favoritoStatus == false) {
                    echo Html::a(FA::icon("star-o", ['class' => 'icon-action-pt']), ['cultravel/adicionar-favoritos', 'idPontoTuristico' => $pontoTuristico->id_pontoTuristico, 'pesquisa' => $pesquisa, 'url' => Yii::$app->controller->getRoute()], ['class' => 'btn-adicionar-favoritos btn btn-danger btn-acao']);
                }

                if ($visitadoStatus == true) {
                    echo Html::a(FA::icon("check-circle", ['class' => 'icon-action-pt'])->size(FA::SIZE_LARGE), ['cultravel/remover-visitados', 'idPontoTuristico' => $pontoTuristico->id_pontoTuristico, 'pesquisa' => $pesquisa, 'url' => Yii::$app->controller->getRoute()], ['class' => 'btn btn-danger btn-acao btn-remover-visitados']);
                } elseif ($visitadoStatus == false) {
                    echo Html::a(FA::icon("check-circle-o", ['class' => 'icon-action-pt'])->size(FA::SIZE_LARGE), ['cultravel/adicionar-visitados', 'idPontoTuristico' => $pontoTuristico->id_pontoTuristico, 'pesquisa' => $pesquisa, 'url' => Yii::$app->controller->getRoute()], ['class' => 'btn btn-danger btn-acao btn-adicionar-visitados']);
                }
            }
            ?>
        </div>
    </div>
    <div class="img-pt-container">
        <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-pt/' . $pontoTuristico->foto, ['class' => 'img-pt']); ?>
    </div>

    <div class="desc-container">
        <h3 class="details-pt-title">DESCRIÇÃO</h3>
        <p class="details-pt"><?= $pontoTuristico->descricao ?></p>
    </div>

    <div class="info-pt">
        <div class="card-info-pt">

            <p class="details-pt-title">TIPO DE MONUMENTO</p>
            <p class="details-pt"><?php
                if ($pontoTuristico->tmIdTipoMonumento != null) {
                    echo $pontoTuristico->tmIdTipoMonumento->descricao;
                } else {
                    echo "Sem informação Disponivel.";
                }
                ?></p>
        </div>
        <div class="card-info-pt">

            <p class="details-pt-title">ESTILO DE CONSTRUÇÃO</p>
            <p class="details-pt"><?php
                if ($pontoTuristico->ecIdEstiloConstrucao != null) {
                    echo $pontoTuristico->ecIdEstiloConstrucao->descricao;
                } else {
                    echo "Sem informação Disponivel.";
                }
                ?></p>

        </div>
        <div class="card-info-pt">
            <p class="details-pt-title">ANO DE CONSTRUÇAO</p>
            <p class="details-pt"><?php
                if ($pontoTuristico->anoConstrucao != null) {
                    echo $pontoTuristico->anoConstrucao;
                } else {
                    echo "Sem informação Disponivel.";
                }
                ?></p>

        </div>
        <div class="card-info-pt">
            <p class="details-pt-title">LOCALIDADE</p>
            <p class="details-pt"><?php
                if ($pontoTuristico->localidadeIdLocalidade != null) {
                    echo $pontoTuristico->localidadeIdLocalidade->nomeLocalidade;
                } else {
                    echo "Sem informação Disponivel.";
                }
                ?></p>

        </div>
        <div class="card-info-pt">

                <p class="details-pt-title">MORADA</p>
                <p class="details-pt"><?php
                    if ($pontoTuristico->morada != null) {
                        echo $pontoTuristico->morada;
                    } else {
                        echo "Sem informação Disponivel.";
                    }
                    ?></p>

        </div>
        <div class="card-info-pt">
                <p class="details-pt-title">HORÁRIO</p>
                <p class="details-pt"><?php
                    if ($pontoTuristico->horario != null) {
                        echo $pontoTuristico->horario;
                    } else {
                        echo "Sem informação Disponivel.";
                    }
                    ?></p>

        </div>
        <div class="card-info-pt">
                <p class="details-pt-title">TELEFONE</p>
                <p class="details-pt"><?php
                    if ($pontoTuristico->telefone != null) {
                        echo $pontoTuristico->telefone;
                    } else {
                        echo "Sem informação Disponivel.";
                    }
                    ?></p>

        </div>
    </div>
    <div class="rating-container-pt">
        <?php
        if (!Yii::$app->user->isGuest) {
        $form = ActiveForm::begin();
        echo $form->field($rating, 'classificacao')->label("")->widget(StarRating::className(), [
            'name' => 'rating_21',
            'value' => $ratingUser,
            'pluginOptions' => [
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'size' => 'md',
                'showCaption' => false,

            ],
        ]);
        ?>
    </div>
    <div class="btn-rating-container">
        <?= Html::submitButton('Avaliar', ['class' => 'btn btn-danger btn-rating']); ?>
    </div>
    <?php
    ActiveForm::end();
    } ?>
</div>
</div>


