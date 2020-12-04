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
<div class="contact-logo-index-container ">

    <?= Html::img('@web/seta-logo.png', ['class' => 'contact-img']); ?>
    <h2>Contacta-nos</h2>

</div>
<div class="ct-ms-container">
    <div class="container-fluid ct-cont-alinha">
        <div class="ct-ms-row">
            <div class="col- col-sm-7 col-md-auto col-{breakpoint}-auto">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'nome')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'assunto') ?>

                <?= $form->field($model, 'mensagem')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col- col-sm-5 col-md-auto col-{breakpoint}-auto">
                <div class="">

                    <h4>As redes sociais onde nos encontramos</h4>

                    <table>

                        <tr>
                            <th class="ct-th"><?= Html::a(Html::img('@web/facebookw2-icon.png', ['class' => 'contact-img-icon']), 'https://www.facebook.com/'); ?></th>
                            <th class="ct-th"><?= Html::a(Html::img('@web/insta2-icon.png', ['class' => 'contact-img-icon']),'https://www.instagram.com/'); ?></th>
                            <th class="ct-th"><?= Html::a(Html::img('@web/tt2-icon.png', ['class' => 'contact-img-icon']),'https://mobile.twitter.com/'); ?></th>
                        </tr>
                        <tr>
                            <th class="ct-th">Facebook</th>
                            <th class="ct-th">Instagram</th>
                            <th class="ct-th">Twitter</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>