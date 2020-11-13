<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;

?>
<div class="registo-container">

    <?= Html::img('@web/seta-logo.png', ['class' => 'logo-registo']); ?>

<div class="registo-info">Registo</div>

<div class="row">
    <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
    </div>
    <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">
        <?php $form = ActiveForm::begin()?>

            <?php
            echo $form->field($modelprofile, 'primeiroNome', ['options' => ['class' => 'label-login']])->hint('Introduza o nome')->textInput(['autofocus' => true]);
            echo $form->field($modelprofile, 'ultimoNome', ['options' => ['class' => 'label-login']])->hint('Introduza o apelido');
            echo $form->field($modelprofile, 'dtaNascimento', ['options' => ['class' => 'label-login']])->hint('Introduza a data de nascimento');
            echo $form->field($model, 'password_hash', ['options' => ['class' => 'label-login']])->passwordInput()->hint('Introduza a palavra-passe');
            echo $form->field($model, 'password_hash', ['options' => ['class' => 'label-login']])->passwordInput()->hint('Confirme a palavra-passe');
            echo $form->field($modelprofile, 'morada', ['options' => ['class' => 'label-login']])->hint('Introduza a morada');
            echo $form->field($modelprofile, 'localidade', ['options' => ['class' => 'label-login']])->hint('Introduza a localidade');
            echo $form->field($modelprofile, 'sexo[]', ['options' => ['class' => 'label-login']])->checkboxList(['a' => 'Masculino', 'b' => 'Feminino'])->hint('Escolha o sexo');?>

        <div class="form-group">
        <?php
        echo Html::submitButton('Registar', ['class' => 'btn btn-warning', 'name' => 'insert-registo']) ?>
        <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>
        </div>
        <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="col-xs-1 col-sm-3 col-md-2 col-lg-3">
    </div>
</div>
