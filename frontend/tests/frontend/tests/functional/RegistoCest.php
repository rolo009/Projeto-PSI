<?php

namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class RegistoCest
{
    protected $registoFormId = '#registoForm';

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
        $I->submitForm('#registoForm', $this->formParams('',
            '', '','','','',
            '','','',''));
        $I->seeValidationError('O campo Primeiro Nome não pode estar em branco!');
        $I->seeValidationError('O campo Último Nome não pode estar em branco!');
        $I->seeValidationError('O campo Nome de Utilizador não pode estar em branco!');
        $I->seeValidationError('O campo Email não pode estar em branco!');
        $I->seeValidationError('O campo Data de Nascimento não pode estar em branco!');
        $I->seeValidationError('O campo Palavra Passe não pode estar em branco!');
        $I->seeValidationError('O campo Confirmar Palavra Passe não pode estar em branco!');
        $I->seeValidationError('O campo Morada não pode estar em branco!');
        $I->seeValidationError('O campo Localidade não pode estar em branco!');
        $I->seeValidationError('O campo Sexo não pode estar em branco!');
    }

    public function RegistoEmailIncorreto(FunctionalTester $I)
    {
        $I->submitForm('#registoForm', $this->formParams('Pedro',
            'Rolo', 'rolo009','pedro123','2020-11-02','123456789',
            '123456789','Rua A','Vila Viçosa','Masculino'));
        $I->dontSeeValidationError('O campo Primeiro Nome não pode estar em branco!');
        $I->dontSeeValidationError('O campo Último Nome não pode estar em branco!');
        $I->dontSeeValidationError('O campo Nome de Utilizador não pode estar em branco!');
        $I->seeValidationError('O campo Email não pode estar em branco!');
        $I->dontSeeValidationError('O campo Data de Nascimento não pode estar em branco!');
        $I->dontSeeValidationError('O campo Palavra Passe não pode estar em branco!');
        $I->dontSeeValidationError('O campo Confirmar Palavra Passe não pode estar em branco!');
        $I->dontSeeValidationError('O campo Morada não pode estar em branco!');
        $I->dontSeeValidationError('O campo Localidade não pode estar em branco!');
        $I->dontSeeValidationError('O campo Sexo não pode estar em branco!');
    }

    public function RegistoCorreto(FunctionalTester $I)
    {
        $I->submitForm('#registoForm', $this->formParams('Pedro',
            'Rolo', 'rolo009','pedro123@hotmail.com','2020-11-02','123456789',
            '123456789','Rua A','Vila Viçosa','Masculino'));

        $I->seeRecord('common\models\User', [
            'username' => 'rolo009',
            'email' => 'pedro123@hotmail.com',
            'status' => \common\models\User::STATUS_INACTIVE
        ]);
        $I->see('Bem vindo à Cultravel Pedro Rolo!');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
