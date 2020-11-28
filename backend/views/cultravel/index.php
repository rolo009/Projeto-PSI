<?php

use yii\helpers\Html;

use rmrevin\yii\fontawesome\FA;

?>
<div class="index-container">
    <?= Html::img('@web/logo-white.png', ['class' => 'logo-registo']); ?>

<div class="container-fluid cards-container">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <?php echo  Html::a('GERIR UTILIZADORES' ,['user/index'], ['class' => 'card-definicoes-admin'])  ?>
        </div>

            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <?php echo  Html::a('GERIR PONTOS TURISTICOS' ,['pontosturisticos/index'], ['class' => 'card-definicoes-admin'])  ?>
            </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <?php echo  Html::a('VER MENSAGENS' ,['contactos/index'], ['class' => 'card-definicoes-admin'])  ?>
        </div>
    </div>
</div>
</div>
</div>