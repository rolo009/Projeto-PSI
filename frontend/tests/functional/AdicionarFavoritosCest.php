<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class AdicionarFavoritosCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/login');
        $I->submitForm('#login-form', [
            'LoginForm[email]' =>'pedrorolo@live.com.pt',
            'LoginForm[password]' => '123456789'], 'insert-login');
        $I->amOnRoute('cultravel/index');


    }

    protected function formParamsLocalidade($localidade)
    {
        return [
            'SearchModel[procurar]' => $localidade,
        ];
    }

    // tests
    public function adicionarFavoritos(FunctionalTester $I)
    {
        $I->seeElement('#searchForm');
        $I->submitForm('#searchForm', $this->formParamsLocalidade('Leiria'));
        $I->see('Resultados da Pesquisa por: Leiria');
        $I->see('Saber Mais');
        $I->click('Saber Mais');
        $I->see('Castelo de Leiria');
        $I->see('1135');
        $I->see('Castelo');
        $I->seeElement('.btn-adicionar-favoritos');
        $I->click('.btn-adicionar-favoritos');
        $I->see('O ponto turistico foi adicionado aos favoritos!');
        $I->see('FAVORITOS');
        $I->see('Castelo de Leiria');
        $I->seeElement('.btn-remover-favoritos');
    }
}
