<?php
use yii\helpers\Html;
?>

<div class="ponto-interesse-container">
    <div class="card-pontos-interesse">
        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-card']); ?>
        <div class="card-body">
            <h5 class="card-title">Castelo de Leiria</h5>
            <p>
                <span class="fa fa-star checked"></span>
                7,8/10</p>
            <div class="pt-btn">
                <?= Html::a('Saber Mais','cultravel/pontoInteresseDetails' , ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
        </div>
    </div>
</div>
