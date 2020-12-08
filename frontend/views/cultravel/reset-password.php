<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?php
            echo $form->field($model, 'oldPassword', ['options' => ['class' => 'label-registo']])->label("Insira a palavra-passe antiga")->passwordInput();
            echo $form->field($model, 'newPassword', ['options' => ['class' => 'label-registo']])->label("Digite a palavra-passe nova")->passwordInput();
            echo $form->field($model, 'newPasswordConfirm', ['options' => ['class' => 'label-registo']])->label("Confirme a palavra-passe nova")->passwordInput();?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>