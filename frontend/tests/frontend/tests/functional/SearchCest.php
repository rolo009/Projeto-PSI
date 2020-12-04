<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class SearchCest
{

    public function _before(FunctionalTester $I)
    {
    }

    protected function formParamsLogin($localidade)
    {
        return [
            'Localidade[nomeLocalidade]' => $localidade,
            ];
    }

    public function SearchTest(FunctionalTester $I)
    {
        $I->amOnRoute('cultavel/index');
        $I->see('Procurar');
        $I->submitForm('#searchForm', $this->formParamsLogin('Leiria'));
        $I->click('Procurar');
        $I->amOnRoute('cultravel/login');
        $I->submitForm('#login-form', $this->formParamsLogin('Pedro', 'pedro123'));
        $I->see('Logout (Pedro)');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');

    }



    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
