<?php

namespace backend\tests\acceptance;
use backend\tests\AcceptanceTester;

class CriarPontoTuristicoCest
{

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/Projeto-Final-PSI/backend/web');

    }

    // tests
    public function tryCriarPontoTuristico(AcceptanceTester $I)
    {
        $I->fillField('LoginForm[email]', 'admin@admin.pt');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('Iniciar Sessão');
        $I->wait(3);
        $I->click('GERIR PONTOS TURISTICOS');
        $I->click('Registar Ponto Turistico');
        $I->selectOption('form select[name="Pontosturisticos[tm_idTipoMonumento]"]', 2);
        $I->selectOption('form select[name="Pontosturisticos[ec_idEstiloConstrucao]"]', 2);
        $I->selectOption('form select[name="Pontosturisticos[localidade_idLocalidade]"]', 2);
        $I->fillField('Pontosturisticos[nome]', 'Palácio');
        $I->fillField('Pontosturisticos[anoConstrucao]', '1960');
        $I->fillField('Pontosturisticos[horario]', '12:00');
        $I->fillField('Pontosturisticos[morada]', 'Leiria');
        $I->fillField('Pontosturisticos[telefone]', '963258741');
        $I->fillField('Pontosturisticos[latitude]', '32');
        $I->fillField('Pontosturisticos[longitude]', '-9');
        $I->fillField('Pontosturisticos[descricao]', '12312312');
        $I->click('Guardar');
        $I->wait(3);
        $I->see("O campo imagem não foi preenchido!");

    }


    public function tryToTest(AcceptanceTester $I)
    {
    }
}
