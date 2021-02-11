<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/Projeto-Final-PSI/frontend/web');
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->click('INICIAR SESSÃO');
        $I->fillField('LoginForm[email]', 'admin@admin.pt');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Iniciar Sessão');
    }
}
