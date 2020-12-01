<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;


use yii\web\AssetBundle;

$this->title = 'Sobre Nós';
?>
<div class="logo-index-container">

    <?= Html::img('@web/seta-logo.png'); ?>

</div>
<div class="sn-about-section">
    <h1>Sobre Nós</h1>
    <p>Some text about who we are and what we do.</p>
    <p>Resize the browser window to see that this page is responsive by the way.</p>
</div>

<h2 class="sn-color" style="text-align:center">A Nossa Equipa</h2>
<div class="row">
    <div class="sn-column">
        <div class="sn-card">
            <img src="index/prft.jpg" alt="Pedro" style="width:100%">
            <div class="sn-container">
                <h2>Pedro Rolo</h2>
                <p class="sn-title">Elemento da equipa</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>[Comming Soon]</p>

            </div>
        </div>
    </div>

    <div class="sn-column">
        <div class="sn-card">
            <img src="index/gmft.jpg" alt="Gustavo" style="width:100%">
            <div class="sn-container">
                <h2>Gustavo Mendonça</h2>
                <p class="sn-title">Elemento da equipa</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>[Comming Soon]</p>

            </div>
        </div>
    </div>

    <div class="sn-column">
        <div class="sn-card">
            <img src="index/mcft.jpg" alt="Mario" style="width:100%">
            <div class="sn-container">
                <h2>Mário Carapinha</h2>
                <p class="sn-title">Elemento da equipa</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>[Comming Soon]</p>

            </div>
        </div>
    </div>
</div>
