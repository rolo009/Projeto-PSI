<?php

namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class RegistoCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/registar');
    }

    protected function formParams($primeiroNome, $ultimoNome, $username, $email, $dtaNascimento, $password, $confirmPassword, $morada, $localidade, $sexo)
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
            'SignupForm[sexo]' => $sexo
            ];
    }

    public function RegistoVerificaVazio(FunctionalTester $I)
    {
        $I->submitForm('#registoForm', []);
       $I->see('O campo Primeiro Nome não pode estar em branco!', '.help-block');
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
        $I->submitForm('#registoForm', [$this->formParams('Pedro',
            'Rolo', 'rolo009','','2020-11-02','123456789',
            '123456789','Rua A','Vila Viçosa','Masculino')]);
        $I->dontSee('O campo Primeiro Nome não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Último Nome não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Nome de Utilizador não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Email não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Data de Nascimento não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Palavra Passe não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Confirmar Palavra Passe não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Morada não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Localidade não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Sexo não pode estar em branco!', '.help-block');
    }

    public function RegistoCorreto(FunctionalTester $I)
    {
        $I->submitForm('#registoForm', [$this->formParams('Pedro',
            'Rolo', 'rolo009','pedro123@hotmail.com','2020-11-02','123456789',
            '123456789','Rua A','Vila Viçosa','Masculino')], 'insert-registo');

        $I->seeRecord('common\models\User', [
            'username' => 'rolo009',
            'email' => 'pedro123@hotmail.com',
            'status' => \common\models\User::STATUS_INACTIVE
        ]);
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
