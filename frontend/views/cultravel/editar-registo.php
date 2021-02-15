<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Registo';
?>

<div class="editar-registo-container">

    <?= Html::img(Yii::$app->urlManagerBackend->baseUrl . '/logo/seta-logo.png', ['class' => 'logo-editar']); ?>

    <div class="editar-registo-info">EDITAR REGISTO</div>

    <div class="row">
        <div class="col-xs-1 col-sm-2 col-md-2 col-lg-2"></div>
        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8">
            <?php $form = ActiveForm::begin() ?>

            <?php
            echo $form->field($profile, 'primeiroNome', ['options' => ['class' => 'label-registo']])->textInput(['autofocus' => true]);
            echo $form->field($profile, 'ultimoNome', ['options' => ['class' => 'label-registo']])->label("Último Nome");
            echo $form->field($user, 'username', ['options' => ['class' => 'label-registo']])->label("Nome de Utilizador");
            echo $form->field($user, 'email', ['options' => ['class' => 'label-registo']])->label("Email");
            echo $form->field($profile, 'dtaNascimento', ['options' => ['class' => 'label-registo']])->label("Data de Nascimento")->
            widget(\yii\jui\DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'language' => 'pt', 'clientOptions' => ['changeMonth' => true, 'changeYear' => true, 'yearRange' => '1930:'.date('Y')],'options'=> ['readonly' => true, 'class'=>'dtaInput', 'autocomplete'=>'off',]]);
            echo $form->field($profile, 'morada', ['options' => ['class' => 'label-registo']])->label("Morada");
            echo $form->field($profile, 'localidade', ['options' => ['class' => 'label-registo']])->label("Localidade");
            echo $form->field($profile, 'distrito', ['options' => ['class' => 'label-registo']])->dropDownList(['Viana do Castelo' => 'Viana do Castelo',
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
            echo $form->field($profile, 'sexo', ['options' => ['class' => 'label-registo']])->radioList(['Masculino' => 'Masculino', 'Feminino' => 'Feminino'])->label("Sexo"); ?>

            <div class="options-editar-registo">
        <span class="btn-options-editar-registo">
            <?php
            echo Html::submitButton('Editar Registo', ['class' => 'btn btn-danger', 'name' => 'insert-registo']) ?>
      </span>
                <span class="btn-options-editar-registo">
        <?= Html::a('Apagar Conta', ['cultravel/apagar-conta'], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar a conta?',
                'method' => 'post']]) ?>

    </span>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="col-xs-1 col-sm-2 col-md-2 col-lg-2"></div>

        </div>
    </div>
</div>


