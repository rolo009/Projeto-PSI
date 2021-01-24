<?php
use yii\helpers\Html;

$this->title = 'Visitados';
?>
<div class="visitados-container">
    <?php
    foreach ($ptLocalidades as $ptLocalidade) {?>
        <div class="card-visitados">
            <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-localidade/'. $ptLocalidade->foto, ['class' => 'img-visitados-card']); ?>
            <h4 class="card-title-visitados">
                <?= $ptLocalidade->nomeLocalidade ?></h4>
            <div class="btn-visitados">
                <?= Html::a('Ver Visitados', ['/cultravel/ponto-interesse-visitados', 'idLocalidade' => $ptLocalidade->id_localidade], ['class' => 'btn btn-warning btn-warning-visitados']) ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>