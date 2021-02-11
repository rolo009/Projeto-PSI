<?php
use yii\bootstrap\Html;
$this->title = "Área de Administração"
?>
<div class="backend-index-container">

<div class="logo-container">
    <?= Html::img('@web/imagens/logo/logo-white.png', ['class' => 'logo-index']); ?>

    <div class="index-container-options">

        <?=  Html::a('GERIR UTILIZADORES' ,['user/index'], ['class' => 'card-definicoes-admin'])  ?>
        <?=  Html::a('GERIR PONTOS TURISTICOS' ,['pontosturisticos/index'], ['class' => 'card-definicoes-admin'])  ?>
        <?=  Html::a('VER MENSAGENS' ,['contactos/index'], ['class' => 'card-definicoes-admin'])  ?>

    </div>
</div>