<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Signup', 'h1');
        $I->see('Please fill out the following fields to signup:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('O campo Primeiro Nome não pode estar em branco!');
        $I->seeValidationError('O campo Email não pode estar em branco!');
        //$I->seeValidationError('Password cannot be blank.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[primeiroNome]' => '213123',
                'SignupForm[ultimoNome]' => '12312',
                'SignupForm[username]' => '31312',
                'SignupForm[email]' => '31312',
                'SignupForm[dtaNascimento]' => date('Y-m-d'),
                'SignupForm[password]' => '31312',
                'SignupForm[confirmPassword]' => '31312',
                'SignupForm[morada]' => '123123',
                'SignupForm[distrito]' => '213123',
                'SignupForm[localidade]' => '123123',
                'SignupForm[sexo]' => '123123'
        ]
        );
        $I->dontSee('O campo Primeiro Nome não pode estar em branco!', '.help-block');
        $I->dontSee('O campo Email não pode estar em branco!', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[primeiroNome]' => 'Pedro',
            'SignupForm[ultimoNome]' => 'Rolo',
            'SignupForm[username]' => 'tester',
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[dtaNascimento]' => date('Y-m-d'),
            'SignupForm[password]' => 'tester_password',
            'SignupForm[confirmPassword]' => 'tester_password',
            'SignupForm[morada]' => 'Leiria',
            'SignupForm[distrito]' => 'Leiria',
            'SignupForm[localidade]' => 'Leiria',
            'SignupForm[sexo]' => 'Masculino'
        ]);

        $I->seeRecord('\common\models\User', [
            'username' => 'tester',
            'email' => 'tester.email@example.com',
            'status' => \common\models\User::STATUS_INACTIVE
        ]);

        $I->seeEmailIsSent();
        $I->see('Thank you for registration. Please check your inbox for verification email.');
    }
}
