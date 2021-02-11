<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class SearchCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/index');
    }

    protected function formParamsSearch($procurar)
    {
        return [
            'SearchModel[procurar]' => $procurar,
            ];
    }

    public function SearchTest(FunctionalTester $I)
    {
        $I->see('PALÁCIO','.opcao-pesquisa');
        $I->seeElement('.procurar');
        $I->seeElement('#searchForm');
        $I->submitForm('#searchForm', $this->formParamsSearch('Leiria'));
        $I->see('Resultados da Pesquisa por: Leiria');
        $I->see('Teste');
    }

}
