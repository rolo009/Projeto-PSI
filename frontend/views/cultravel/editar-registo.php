<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use rmrevin\yii\fontawesome\FA;
use yii\web\AssetBundle;

$this->title = 'Editar Registo';
?>

<div class="editar-container">

    <?= Html::img('@web/seta-logo.png', ['class' => 'logo-editar']); ?>

    <div class="editar-info">Editar Registo</div>

    <div class="row">
        <div class="col-xs-1 col-sm-2 col-md-3 col-lg-3">
        </div>
        <div class="col-xs-10 col-sm-8 col-md-6 col-lg-6">
            <?php $form = ActiveForm::begin()?>

            <?php
            echo $form->field($profile, 'primeiroNome', ['options' => ['class' => 'label-registo']])->textInput(['autofocus' => true]);
            echo $form->field($profile, 'ultimoNome', ['options' => ['class' => 'label-registo']])->label("Último Nome");
            echo $form->field($user, 'username', ['options' => ['class' => 'label-registo']])->label("Nome de Utilizador");
            echo $form->field($user, 'email', ['options' => ['class' => 'label-registo']])->label("Email");
            echo $form->field($profile, 'dtaNascimento', ['options' => ['class' => 'label-registo']])->label("Data de Nascimento")->widget(\yii\jui\DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd']);
            //echo $form->field($user, 'password', ['options' => ['class' => 'label-registo']])->label("Palavra Passe")->passwordInput();
            //echo $form->field($profile, 'confirmPassword', ['options' => ['class' => 'label-registo']])->label("Confirmar Palavra Passe")->passwordInput();
            echo $form->field($profile, 'morada', ['options' => ['class' => 'label-registo']])->label("Morada");
            echo $form->field($profile, 'localidade', ['options' => ['class' => 'label-registo']])->label("Localidade");
            echo $form->field($profile, 'distrito',['options' => ['class' => 'label-registo']])->dropDownList(['Viana do Castelo'=>'Viana do Castelo',
                'Braga'=>'Braga',
                'Vila Real'=>'Vila Real',
                'Bragança'=>'Bragança',
                'Porto'=>'Porto',
                'Aveiro'=>'Aveiro',
                'Viseu'=>'Viseu',
                'Guarda'=>'Guarda',
                'Coimbra'=>'Coimbra',
                'Castelo Branco'=>'Castelo Branco',
                'Leiria'=>'Leiria',
                'Santarém'=>'Santarém',
                'Portalegre'=>'Portalegre',
                'Lisboa'=>'Lisboa',
                'Évora'=>'Évora',
                'Setubal'=>'Setubal',
                'Beja'=>'Beja',
                'Faro'=>'Faro',
                'Açores'=>'Açores',
                'Madeira'=>'Madeira'
            ])->label("Distrito");
            echo $form->field($profile, 'sexo', ['options' => ['class' => 'label-registo']])->radioList( ['Masculino'=>'Masculino', 'Feminino' => 'Feminino'] )->label("Sexo");?>
?>
            <div class="form-group">
                <?php
                echo Html::submitButton('Editar Registo', ['class' => 'btn btn-warning', 'name' => 'insert-registo']) ?>
                <?php /* Html::a('<i class="fa fa-fw fa-user"></i> Sign Up',['site/signup'], ['class' => 'btn btn-black', 'title' => 'Sign Up']) */ ?>
            </div>
            <?php ActiveForm::end(); ?>

            <?= Html::a('Apagar Conta', ['cultravel/apagar-conta'], ['class' => 'btn btn-danger btn-pi-info',
                'confirm' => 'Tem a certeza que pretende apagar a conta?',
                'method' => 'post',]) ?>
            <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que pretende apagar este utilizador?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <div class="col-xs-1 col-sm-3 col-md-2 col-lg-3">
    </div>
</div>

