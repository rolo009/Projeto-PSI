<?php

namespace frontend\tests\functional;
use common\models\User;
use frontend\tests\FunctionalTester;

class RegistoCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/registar');
    }

    protected function formParams($primeiroNome, $ultimoNome, $username, $email, $dtaNascimento, $password, $confirmPassword, $morada, $localidade, $distrito, $sexo)
    {
        return [
            'SignupForm[primeiroNome]' => $primeiroNome,
            'SignupForm[ultimoNome]' => $ultimoNome,
            'SignupForm[username]' => $username,
            'SignupForm[email]' => $email,
            'SignupForm[dtaNascimento]' => $dtaNascimento,
            'SignupForm[password]' => $password,
            'SignupForm[confirmPassword]' => $confirmPassword,
            'SignupForm[morada]' => $morada,
            'SignupForm[localidade]' => $localidade,
            'SignupForm[distrito]' => $distrito,
            'SignupForm[sexo]' => $sexo
            ];
    }

    public function RegistoVerificaVazio(FunctionalTester $I)
    {
        $I->submitForm('#registoForm', [
            'SignupForm[primeiroNome]' => '',
            'SignupForm[ultimoNome]' => '',
            'SignupForm[username]' => '',
            'SignupForm[email]' => '',
            'SignupForm[dtaNascimento]' => '',
            'SignupForm[password]' => '',
            'SignupForm[confirmPassword]' => '',
            'SignupForm[morada]' => '',
            'SignupForm[localidade]' => '',
            'SignupForm[distrito]' => '',
            'SignupForm[sexo]' => ''
        ]);
       $I->seeValidationError('O campo Primeiro Nome não pode estar em branco!');
        $I->see('O campo Último Nome não pode estar em branco!', '.help-block');
        $I->see('O campo Nome de Utilizador não pode estar em branco!', '.help-block');
        $I->see('O campo Email não pode estar em branco!', '.help-block');
        $I->see('O campo Data de Nascimento não pode estar em branco!', '.help-block');
        $I->see('O campo Palavra Passe não pode estar em branco!', '.help-block');
        $I->see('O campo Confirmar Palavra Passe não pode estar em branco!', '.help-block');
        $I->see('O campo Morada não pode estar em branco!', '.help-block');
        $I->see('O campo Localidade não pode estar em branco!', '.help-block');
        $I->see('O campo Sexo não pode estar em branco!', '.help-block');
    }

    public function RegistoEmailIncorreto(FunctionalTester $I)
    {
        $I->submitForm('#registoForm', [
            'SignupForm[primeiroNome]' => 'Teste',
            'SignupForm[ultimoNome]' => 'Registo',
            'SignupForm[username]' => 'teste_registo123',
            'SignupForm[email]' => 'teste_registo',
            'SignupForm[dtaNascimento]' => '2020-11-02',
            'SignupForm[password]' => '123456789',
            'SignupForm[confirmPassword]' => '123456789',
            'SignupForm[morada]' => 'Rua A',
            'SignupForm[localidade]' => 'Vila Viçosa',
            'SignupForm[distrito]' => 'Évora',
            'SignupForm[sexo]' => 'Masculino'
        ]);
        $I->see('Primeiro Nome');
        $I->See('Email is not a valid email address.', '.help-block');
    }

    public function RegistoCorreto(FunctionalTester $I)
    {
        $I->submitForm('#registoForm', [
            'SignupForm[primeiroNome]' => 'Teste',
            'SignupForm[ultimoNome]' => 'Registo',
            'SignupForm[username]' => 'teste_registo123',
            'SignupForm[email]' => 'teste_registo@hotmail.com',
            'SignupForm[dtaNascimento]' => '2020-11-02',
            'SignupForm[password]' => '123456789',
            'SignupForm[confirmPassword]' => '123456789',
            'SignupForm[morada]' => 'Rua A',
            'SignupForm[localidade]' => 'Vila Viçosa',
            'SignupForm[distrito]' => 'Évora',
            'SignupForm[sexo]' => 'Masculino'
            ]);
           /* $this->formParams('Teste',
            'Registo', 'teste_registo123','teste_registo@hotmail.com','2020-11-02','123456789',
            '123456789','Rua A','Vila Viçosa','Évora','Masculino')], 'insert-registo')*/

        $I->see("Bem Vindo");
//Registo não é efetuado!
        $I->seeRecord(User::className(), [
            'username' => 'teste_registo123',
            'email' => 'teste_registo@hotmail.com',
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $I->seeRecord('common\models\Userprofile', [
            'primeiroNome' => 'Teste',
            'localidade' => 'Vila Viçosa',
        ]);
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
