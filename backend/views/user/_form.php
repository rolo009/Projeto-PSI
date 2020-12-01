<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropdownList(
        ['0' => 'Banir Utilizador', '9' => 'Utilizador Inativo', '10' => 'Utilizador Ativo'],
        ['prompt' => 'Estado Mensagem']
    )->label("Estado Mensagem"); ?>

    <div class="form-group">

        <?= Html::submitButton('Alterar Estado User', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar este utilizador?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
