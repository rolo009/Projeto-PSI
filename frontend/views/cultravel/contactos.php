<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;
use yii\captcha\Captcha;

$this->title = 'Contactos';

?>
<div class="contactos-container">
    <div class="contactos-logo ">

        <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/logo/seta-logo.png', ['class' => 'contact-img']); ?>

        <h2>CONTACTA-NOS</h2>

    </div>
    <div class="row contactos-form">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'nome')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'assunto') ?>
            <?= $form->field($model, 'mensagem')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="image-captcha">{image}</div><div class="input-captcha">{input}</div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <div class="redes-sociais-container">
                <?= Html::a(Html::img(Yii::$app->urlManagerBackend->baseUrl . '/icones/facebook.png', ['class' => 'contact-img-icon']), 'https://www.facebook.com/'); ?>
                <?= Html::a(Html::img(Yii::$app->urlManagerBackend->baseUrl . '/icones/instagram.png', ['class' => 'contact-img-icon']), 'https://www.instagram.com/'); ?>
                <?= Html::a(Html::img(Yii::$app->urlManagerBackend->baseUrl . '/icones/twitter.png', ['class' => 'contact-img-icon']), 'https://twitter.com/'); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
    </div>
</div>