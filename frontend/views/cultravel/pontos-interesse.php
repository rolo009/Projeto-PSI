<?php

use yii\helpers\Html;

$this->title = $localidade;

?>

<div class="pontos-interesse-container">
    <?php
    foreach ($pontosTuristicos as $pontoTuristico) { ?>
        <div class="card-pontos-interesse">
            <?= Html::img('@web/imagens/' . $pontoTuristico->foto, ['class' => 'img-pi-card']); ?>
            <h5>
                <?= $pontoTuristico->nome ?>
            </h5>
            <div>
                <?= Html::a('Saber Mais', ['cultravel/ponto-interesse-details', 'id' => $pontoTuristico->id_pontoTuristico], ['class' => 'btn btn-warning btn-pi-info']) ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>
