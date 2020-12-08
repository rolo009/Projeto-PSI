<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class SearchCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/index');
    }

    protected function formParamsLogin($localidade)
    {
        return [
            'Localidade[nomeLocalidade]' => $localidade,
            ];
    }

    public function SearchTest(FunctionalTester $I)
    {

        $I->see('MONUMENTOS','.opcao-pesquisa');
       /* $I->see('Procurar');
        $I->submitForm('#searchForm', $this->formParamsLogin('Leiria'));
        $I->click('Procurar');
        $I->amOnRoute('cultravel/login');*/

    }



    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
