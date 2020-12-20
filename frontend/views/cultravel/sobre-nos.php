<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;


use yii\web\AssetBundle;

$this->title = 'Sobre Nós';
?>
<div class="logo-index-container">

    <?= Html::img('@web/imagens/logo/seta-logo.png'); ?>

</div>
<div class="sn-about-section">
    <h1>Sobre Nós</h1>
    <p class="sn-about-section-text">A CulTravel foi desenvolvida no ano de 2020. Nós idealizamos que sair, conhecer a cultura e os monumentos que nos foram deixados pudesse estar mais ao alcanse de qualquer um, pois com a aplicação não tem de se dirigir a um ponto de turistico e ter de estar no horario para pedir informação, por outro lado tambem não precisa de perder horas a fazer pesquisa e um plano de ação sobre a zona a visitar, pode encontrar isto tudo com bastante facilidade e comudidade conosco. Desde inicio que o nosso objetivo foi facilitar e trazer uma multi ferramenta, no que toca ao conhecimento cultural e de viagens. Sendo assim nada como uma app no dispositivo que anda sempre conosco.     </p>
    <p></p>
</div>

<h2 class="sn-title-ane">A Nossa Equipa</h2>
<div class="sn-row">
    <div class="sn-column">
        <div class="sn-card">
            <img src="index/prft.jpg" alt="Pedro" style="width:100%">
            <div class="sn-container">
                <h2>Pedro Rolo</h2>
                <p>Elemento da equipa</p>
                <p>Alguns pontos sobre esta pessoa.</p>
                <p>[Comming Soon]</p>

            </div>
        </div>
    </div>

    <div class="sn-column">
        <div class="sn-card">
            <img src="index/gmft.jpg" alt="Gustavo" style="width:100%">
            <div class="sn-container">
                <h2>Gustavo Mendonça</h2>
                <p>Elemento da equipa</p>
                <p>Alguns pontos sobre esta pessoa.</p>
                <p>[Comming Soon]</p>

            </div>
        </div>
    </div>

    <div class="sn-column">
        <div class="sn-card">
            <img src="index/mcft.jpg" alt="Mario" style="width:100%">
            <div class="sn-container">
                <h2>Mário Carapinha</h2>
                <p>Elemento de equipa</p>
                <p>Alguns pontos sobre esta pessoa.</p>
                <p>[Comming Soon]</p>

            </div>
        </div>
    </div>
</div>
