<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;

use yii\web\AssetBundle;

$this->title = 'Página Inicial';

?>

<div class="index-container">
    <div class="logo-index-container">
        <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/logo/logo-white.png', ['class' => 'logo-index']); ?>
    </div>

    <div class="container-fluid searchForm-container">
        <?php $form = ActiveForm::begin(['id' => 'searchForm']) ?>
        <?= $form->field($model, 'procurar', [
            'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn">' .
                '<button class="btn btn-danger">'.FA::icon("search").'</button></span></div>',
        ])->label(false); ?>


        <div class="row search-btns">
            <span class="opcao-pesquisa">
                <?= Html::a(FA::icon("bank", ['class' => 'icon-index-search']) . 'PALÁCIO', ['cultravel/pontos-interesse-filtro', 'filtro' => 'Palácio']); ?>
            </span>
            <span class="opcao-pesquisa">
                <?= Html::a(FA::icon("bank", ['class' => 'icon-index-search']) . 'MUSEU', ['cultravel/pontos-interesse-filtro', 'filtro' => 'Museu']); ?>
            </span>
            <span class="opcao-pesquisa">
                <?= Html::a(FA::icon("bank", ['class' => 'icon-index-search']) . 'CASTELO' . '', ['cultravel/pontos-interesse-filtro', 'filtro' => 'Castelo']); ?>
            </span>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
