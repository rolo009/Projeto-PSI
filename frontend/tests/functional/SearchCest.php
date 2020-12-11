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
        $I->see('Procurar');
        $I->seeElement('#searchForm');
        $I->submitForm('#searchForm', $this->formParamsLogin('Leiria'));
        $I->see('Resultados da Pesquisa por: Leiria');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
}
