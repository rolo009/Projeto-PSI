<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;

?>

<div class="logo-index-container">

    <?= Html::img('@web/seta-logo.png'); ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin()?>

            <?php
            echo $form->field($modelprofile, 'primeiroNome', ['options' => ['class' => 'label-login']])->textInput(['autofocus' => true]);
            echo $form->field($modelprofile, 'ultimoNome', ['options' => ['class' => 'label-login']]);
            echo $form->field($modelprofile, 'dtaNascimento', ['options' => ['class' => 'label-login']]);
            echo $form->field($model, 'password_hash', ['options' => ['class' => 'label-login']])->passwordInput();
            echo $form->field($model, 'password_hash', ['options' => ['class' => 'label-login']])->passwordInput();
            echo $form->field($modelprofile, 'morada', ['options' => ['class' => 'label-login']]);
            echo $form->field($modelprofile, 'localidade', ['options' => ['class' => 'label-login']]);
            echo $form->field($modelprofile, 'sexo', ['options' => ['class' => 'label-login']])->checkbox();?>

            <div class="form-group">
                <?php
                echo Html::submitButton('Editar Registo', ['class' => 'btn btn-warning', 'name' => 'insert-registo']) ?>
                <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
