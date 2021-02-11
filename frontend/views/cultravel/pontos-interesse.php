<?php

use yii\bootstrap4\LinkPager;
use yii\helpers\Html;

if (isset($resultado) && $resultado != null) {
    $this->title = $resultado;
} elseif (isset($tipoMonumento) && $tipoMonumento != null) {
    $this->title = $tipoMonumento;
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pontos-interesse-container">

    <div class="info-resultado">
        Resultados da Pesquisa por: <span class="resultado"><?php if (isset($resultado) && $resultado != null) {
                echo $resultado;
            } elseif (isset($tipoMonumento) && $tipoMonumento != null) {
                echo $tipoMonumento;
            } ?></span>
    </div>
    <div class="pontos-interesse-card-container">

        <?php
        foreach ($pontosTuristicos as $pontoTuristico) { ?>
            <div class="card-pontos-interesse">
                <?php
                echo Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-pt/' . $pontoTuristico->foto, ['class' => 'img-pi-card']);
                ?>
                <h5 class="nome-pt">
                    <?= $pontoTuristico->nome ?>
                </h5>
                <div>
                    <?= Html::a('Saber Mais', ['cultravel/ponto-interesse-details', 'pesquisa' => $this->title, 'id' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-danger btn-pi-info']) ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="pagination-page">
    <?= LinkPager::widget([
            'pagination' => $pages,
        ]);?>
</div>
</div>
