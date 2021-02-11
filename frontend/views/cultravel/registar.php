<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registar';
?>
<div class="registo-container">
    <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/logo/seta-logo.png', ['class' => 'logo-registo']); ?>

    <div class="registo-info">REGISTO</div>

    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <?php $form = ActiveForm::begin(['id' => 'registoForm']) ?>

            <?php
            echo $form->field($model, 'primeiroNome', ['options' => ['class' => 'label-registo']])->textInput(['autofocus' => true]);
            echo $form->field($model, 'ultimoNome', ['options' => ['class' => 'label-registo']])->label("Último Nome");
            echo $form->field($model, 'username', ['options' => ['class' => 'label-registo']])->label("Nome de Utilizador");
            echo $form->field($model, 'email', ['options' => ['class' => 'label-registo']])->label("Email");
            echo $form->field($model, 'dtaNascimento', ['options' => ['class' => 'label-registo']])->label("Data de Nascimento")->
            widget(\yii\jui\DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd','clientOptions' => ['changeMonth' => true, 'changeYear' => true],'options'=> ['readonly' => true, 'class'=>'dtaInput', 'autocomplete'=>'off',]]);
            echo $form->field($model, 'password', ['options' => ['class' => 'label-registo']])->label("Palavra Passe")->passwordInput();
            echo $form->field($model, 'confirmPassword', ['options' => ['class' => 'label-registo']])->label("Confirmar Palavra Passe")->passwordInput();
            echo $form->field($model, 'morada', ['options' => ['class' => 'label-registo']])->label("Morada");
            echo $form->field($model, 'localidade', ['options' => ['class' => 'label-registo']])->label("Localidade");
            echo $form->field($model, 'distrito', ['options' => ['class' => 'label-registo']])->dropDownList(['Viana do Castelo' => 'Viana do Castelo',
                'Braga' => 'Braga',
                'Vila Real' => 'Vila Real',
                'Bragança' => 'Bragança',
                'Porto' => 'Porto',
                'Aveiro' => 'Aveiro',
                'Viseu' => 'Viseu',
                'Guarda' => 'Guarda',
                'Coimbra' => 'Coimbra',
                'Castelo Branco' => 'Castelo Branco',
                'Leiria' => 'Leiria',
                'Santarém' => 'Santarém',
                'Portalegre' => 'Portalegre',
                'Lisboa' => 'Lisboa',
                'Évora' => 'Évora',
                'Setubal' => 'Setubal',
                'Beja' => 'Beja',
                'Faro' => 'Faro',
                'Açores' => 'Açores',
                'Madeira' => 'Madeira'
            ])->label("Distrito");
            echo $form->field($model, 'sexo', ['options' => ['class' => 'label-registo']])->radioList(['Masculino' => 'Masculino', 'Feminino' => 'Feminino'])->label("Sexo"); ?>

            <div class="form-group">
                <?php
                echo Html::submitButton('Registar', ['class' => 'btn btn-danger', 'name' => 'insert-registo']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
    </div>
</div>
