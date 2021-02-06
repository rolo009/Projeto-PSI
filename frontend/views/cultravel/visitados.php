<?php
use yii\helpers\Html;

$this->title = 'Visitados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitados-container">
    <?php
    foreach ($ptVisitados as $ptVisitado) {?>
        <div class="card-visitados">
            <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/img-localidade/'. $ptVisitado->localidadeIdLocalidade->foto, ['class' => 'img-visitados-card']); ?>
            <h4 class="card-title-visitados">
                <?= $ptVisitado->localidadeIdLocalidade->nomeLocalidade ?></h4>
            <div class="btn-visitados">
                <?= Html::a('Ver Visitados', ['/cultravel/ponto-interesse-visitados', 'idLocalidade' => $ptVisitado->localidadeIdLocalidade->id_localidade], ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>