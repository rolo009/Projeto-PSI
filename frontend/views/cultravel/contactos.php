<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;
use yii\captcha\Captcha;

$this->title = 'Contact';

?>
<div class="logo-index-container">

    <?= Html::img('@web/seta-logo.png', ['class' => 'contact-img']); ?>

</div>
<div class="ct-ms-container">
    <div class="container-fluid">
        <div class="ct-ms-row">
            <div class="col- col-sm-7 col-md-auto col-{breakpoint}-auto">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'subject') ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="col- col-sm-5 col-md-auto col-{breakpoint}-auto">
                <div>

                    <h2>As redes sociais onde nos encontramos</h2>

                    <table>

                        <tr>
                            <th><img src="index/face-icon.png" class="contact-img" style="width:20%" ></th>
                            <th><img src="index/insta-icon.png" class="contact-img" style="width:20%" ></th>
                            <th><img src="index/tt-icon.png" class="contact-img" style="width:20%" ></th>
                        </tr>
                        <tr>
                            <th>Facebook</th>
                            <th>Instagram</th>
                            <th>Twitter</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>