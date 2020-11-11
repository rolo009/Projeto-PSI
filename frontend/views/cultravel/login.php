<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;

?>
<div class="logo-index-container">

    <?= Html::img('@web/seta-logo.png'); ?>

</div>

<div>
    <div class="searchForm-container">
        <?php $form = ActiveForm::begin()?>

        <?php
        echo $form->field($model, 'email', ['options' => ['class' => 'label-login']]);
        echo $form->field($model, 'password_hash', ['options' => ['class' => 'label-login']]); ?>

        <?php
        echo Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-warning', 'name' => 'insert-login']) ?>
        <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>
        <?php ActiveForm::end(); ?>

    </div>
</div>
