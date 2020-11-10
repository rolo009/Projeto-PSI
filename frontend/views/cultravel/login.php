<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;

?>
<div class="logo-index-container">

    <?= Html::img('@web/seta-logo.png'); ?>

    <p class="label-login">Preencha os campos do login:</p>

<div class="row">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin()?>

            <?php
            echo $form->field($model, 'email', ['options' => ['class' => 'label-login']]); ?>
            <?php
             echo $form->field($model, 'password_hash', ['options' => ['class' => 'label-login']])->passwordInput(); ?>

            <div style="color:#999;margin:1em 0">
                <?= Html::a('Esqueceu-se da palavra-passe?', ['site/request-password-reset']) ?>.
                <br>
                <?= Html::a('Verificação do email', ['site/resend-verification-email']) ?>
            </div>

            <div class="form-group">
            <?php
            echo Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-warning', 'name' => 'insert-login']) ?>
            </div>

            <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

