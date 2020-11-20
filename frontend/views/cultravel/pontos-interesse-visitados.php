<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
?>
<div class="pontos-interesse-visitados-container">
    <div>
        <?php
        $localidade->nomeLocalidade;
        ?>
    </div>
    <?php
    foreach ($ptVisitados as $ptVisitado) {
        ?>
        <div class="card-pontos-interesse-visitados">
            <?=Html::img('@web/'.$ptVisitado -> foto, ['class' => 'img-pi-card-pt-visitados']); ?>
            <h5>
                <?= $ptVisitado -> nome ?>
            </h5>
            <div>
                <?= Html::a('Saber Mais', ['cultravel/ponto-interesse-details', 'id'=> $ptVisitado -> id_pontoTuristico], ['class' => 'btn btn-warning btn-pi-visitado-info']) ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>