<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;

if (Yii::$app->session->hasFlash('success'))
{
    ?>
<div class="flash-login">
    <?= Yii::$app->session->getFlash('success'); ?>
</div>
<?php
}
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("Email") ?>

    <?= $form->field($model, 'password')->passwordInput()->label("Palavra-Passe") ?>

    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Iniciar Sessão', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

