<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;


use yii\web\AssetBundle;

$this->title = 'Sobre Nós';
?>
<div class="sobre-nos-container">

    <div class="logo-container">
        <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/logo/seta-logo.png', ['class' => 'sobre-nos-logo']); ?>
        <h2>SOBRE NÓS</h2>
    </div>
    <div class="sobre-nos-desc">

        <p>A CulTravel foi desenvolvida no ano de 2020. Nós idealizamos que
            sair, conhecer a cultura e os monumentos que nos foram deixados pudesse estar mais ao alcanse de qualquer um, pois com a
            aplicação não tem de se dirigir a um ponto de turistico e ter de estar no horario para pedir informação, por
            outro lado tambem não precisa de perder horas a fazer pesquisa e um plano de ação sobre a zona a visitar,
            pode encontrar isto tudo com bastante facilidade e comudidade conosco. Desde inicio que o nosso objetivo foi
            facilitar e trazer uma multi ferramenta, no que toca ao conhecimento cultural e de viagens. Sendo assim nada
            como uma app no dispositivo que anda sempre conosco. </p>
        <p></p>
    </div>

    <h2 style="text-align: center; color: white" >A NOSSA EQUIPA</h2>

    <div class="sobrenos-container">
        <div class="sobrenos-card">
            <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-collaborators/pedro.jpeg', ['class' => 'sobrenos-card-img']); ?>
            <div class="sobrenos-card-text">
                <h3>Pedro Rolo</h3>
                <p>Elemento da equipa</p>
            </div>
        </div>

        <div class="sobrenos-card">
            <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-collaborators/gustavo.jpg', ['class' => 'sobrenos-card-img']); ?>

            <div class="sobrenos-card-text">
                <h3>Gustavo Mendonça</h3>
                <p>Elemento da equipa</p>

            </div>
        </div>

        <div class="sobrenos-card">
            <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-collaborators/mario.jpg', ['class' => 'sobrenos-card-img']); ?>
            <div class="sobrenos-card-text">
                <h3>Mário Carapinha</h3>
                <p>Elemento de equipa</p>
            </div>
        </div>
    </div>
</div>

