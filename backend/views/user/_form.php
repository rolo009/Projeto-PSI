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
        ['prompt' => '']
    )->label("Estado Conta"); ?>

    <div class="form-group">

        <?= Html::submitButton('Alterar Estado Utilizador', ['class' => 'btn btn-success']) ?>
        <?php
        if(Yii::$app->authManager->checkAccess($model->id, 'admin') == true){
            echo  Html::a('Remover Administrador', ['remover-admin', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Tem a certeza que pretende remover este utilizador de Administrador?',
                    'method' => 'post',
                ],
            ]);
        }elseif (Yii::$app->authManager->checkAccess($model->id, 'user')){
           echo  Html::a('Tornar Administrador', ['tornar-admin', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Tem a certeza que pretende tornar este utilizador de Administrador?',
                    'method' => 'post',
                ],
            ]);
        }
         ?>
        <?= Html::a('Apagar Utilizador', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger  pull-right',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar este utilizador?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
