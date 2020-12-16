<?php

namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class LoginCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/login');
    }

    protected function formParamsLogin($login, $password)
    {
        return [
            'LoginForm[email]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function verificaLoginVazio(FunctionalTester $I)
    {
        $I->am('guest');
        $I->seeElement('#login-form');
        $I->click('Iniciar Sessão');
        //Não vê as mensagens de erro
        $I->seeValidationError('O campo Email não pode estar em branco!');
        $I->seeValidationError('O campo Password não pode estar em branco!');
    }

    public function LoginTest(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/index');
        $I->see('INICIAR SESSÃO');
        $I->click('INICIAR SESSÃO');
        $I->amOnRoute('cultravel/login');
        $I->submitForm('#login-form', $this->formParamsLogin('test_registo@live.com.pt', '123456789'));
        $I->see('ÁREA PESSOAL');
        $I->dontSeeLink('INICIAR SESSÃO');
        $I->dontSeeLink('REGISTAR');

    }

    public function verificaPalavraPasseIncorreta(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParamsLogin('test_registo@live.com.pt', 'errada'));
        //Não vê as mensagens de erro
        $I->seeValidationError('Email ou Password Incorretos!');
    }

    public function checkInactiveAccount(FunctionalTester $I)
    {
       /* $I->submitForm('#login-form', $this->formParams('test.test', 'Test1234'));
        $I->seeValidationError('Incorrect username or password');*/
    }

    public function checkValidLogin(FunctionalTester $I)
    {
        /*$I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->see('Logout (erau)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');*/
    }
}
