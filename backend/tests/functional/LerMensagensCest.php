<?php namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\models\Contactos;

class LerMensagensCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/login');
        $I->submitForm('#login-form', $this->formParamsLogin('test_registo@live.com.pt', '123456789'));
    }

    protected function formParamsLogin($login, $password)
    {
        return [
            'LoginForm[email]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

// tests
    public function VerMensagensTest(FunctionalTester $I)
    {
        $I->see('VER MENSAGENS');
        $I->click('VER MENSAGENS');
        $I->amOnRoute('contactos/index');
        $I->see('Testar Contactos');
        $I->seeElement('.glyphicon-eye-open');
        $I->click('.glyphicon-eye-open');
        $contacto = Contactos::findOne(['email' => 'teste_contactos@gmail.com']);
        $I->amOnRoute('contactos/view', ['id' => $contacto->idContactos]);
        $I->see('Testar Contactos');
        $I->see('teste_contactos@gmail.com');
        $I->see('Atualizar Mensagem');
        $I->seeElement('#contactos-status');
        $I->click('#contactos-status');
        $I->see('Mensagem Lida');
        $I->selectOption('form select[name="Contactos[status]"]', 1);
        $I->click('Atualizar Mensagem');
        $I->see('Mensagem Lida (1)');


    }
}
