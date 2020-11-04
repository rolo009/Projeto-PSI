<?php
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
?>

<div class="favourite-container">
    <div class="card favourite-ponto-interesse">
        <div class="favorite-header">
            <h4>
                <div class="favourite-options">
                    <a href="#" class="btn btn-warning"><?= FA::icon("star") ?></a>
                    <a href="#" class="btn btn-warning"><?= FA::icon("check") ?></a>
                </div>

            </h4>
        </div>
        <div class="favorite-body">
            <table style="width:100%">
                <tr>
                    <th class="img-pi-favoritos-container">
                        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-favoritos']); ?>
                    </th>
                    <th class="nome-pi-container">
                        Castelo de Leiria
                    </th>
                    <th class="localidade-pi-container">
                        Leiria
                    </th>
                </tr>
            </table>
        </div>

    </div>

    <div class="card favourite-ponto-interesse">
        <div class="favorite-header">
            <h4>
                <div class="favourite-options">
                    <a href="#" class="btn btn-warning"><?= FA::icon("star") ?></a>
                    <a href="#" class="btn btn-warning"><?= FA::icon("check") ?></a>
                </div>

            </h4>
        </div>
        <div class="favorite-body">
            <table style="width:100%">
                <tr>
                    <th class="img-pi-favoritos-container">
                        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-favoritos']); ?>
                    </th>
                    <th class="nome-pi-container">
                        Castelo de Leiria
                    </th>
                    <th class="localidade-pi-container">
                        Leiria
                    </th>
                </tr>
            </table>
        </div>

    </div>

    <div class="card favourite-ponto-interesse">
        <div class="favorite-header">
            <h4>
                <div class="favourite-options">
                    <a href="#" class="btn btn-warning"><?= FA::icon("star") ?></a>
                    <a href="#" class="btn btn-warning"><?= FA::icon("check") ?></a>
                </div>

            </h4>
        </div>
        <div class="favorite-body">
            <table style="width:100%">
                <tr>
                    <th class="img-pi-favoritos-container">
                        <?= Html::img('@web/castelo-de-leiria.jpg', ['class' => 'img-pi-favoritos']); ?>
                    </th>
                    <th class="nome-pi-container">
                        Castelo de Leiria
                    </th>
                    <th class="localidade-pi-container">
                        Leiria
                    </th>
                </tr>
            </table>
        </div>

    </div>
</div>