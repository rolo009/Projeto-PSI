<?php

use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;

?>

<div class="favourite-container">
    <?php
    foreach ($ptFavoritos as $ptFavorito) { ?>
        <div class="card favourite-ponto-interesse">
            <div class="favorite-header">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">

                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                <table style="width:100%">
                    <tr>
                        <th>
                        </th>
                        <th>
                            <div class="favourite-options">
                                <a href="#" class="btn btn-warning"><?= FA::icon("star") ?></a>
                            </div>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="favorite-body">
                <table>
                    <tr>
                        <th class="img-pi-favoritos-container">
                            <?= Html::img('@web/'.$ptFavorito[0]->foto, ['class' => 'img-pi-favoritos']); ?>
                        </th>
                        <th class="nome-pi-container">
                            <?php
                            echo $ptFavorito[0]->nome
                            ?>
                        </th>
                        <th class="btn-pi">
                            <a href="#" class="btn btn-outline-dark"><?= FA::icon("angle-double-right") ?></a>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</div>