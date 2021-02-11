<?php

namespace backend\tests;

use common\models\Estiloconstrucao;
use common\models\Localidade;
use common\models\Pontosturisticos;
use common\models\Tipomonumento;

class PontosTuristicosTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * Teste Unitário PontoTuristico
     */

    public function testValidacaoPontoTuristico()
    {

        $pontoTuristico = new Pontosturisticos();

        //Despoletar todas as regras de validação

        //Nome Ponto Turistico
        $pontoTuristico->nome = null;
        $this->assertFalse($pontoTuristico->validate(['nome']));

        $pontoTuristico->nome = 'Castelo de Leiria';
        $this->assertTrue($pontoTuristico->validate(['nome']));

        //Ano de Construção

        $pontoTuristico->anoConstrucao = null;
        $this->assertTrue($pontoTuristico->validate(['anoConstrucao']));

        $pontoTuristico->anoConstrucao = '1135';
        $this->assertTrue($pontoTuristico->validate(['anoConstrucao']));

        //Descrição

        $pontoTuristico->descricao = null;
        $this->assertFalse($pontoTuristico->validate(['descricao']));

        $pontoTuristico->descricao = 'Localizado em Leiria';
        $this->assertTrue($pontoTuristico->validate(['descricao']));

        //Foto

        $pontoTuristico->foto = 'castelo-de-leiria.jpg';
        $this->assertTrue($pontoTuristico->validate(['foto']));

        //Tipo de Monumento

        $pontoTuristico->tm_idTipoMonumento = Tipomonumento::findOne(['descricao' => 'Castelo'])->idTipoMonumento;
        $this->assertTrue($pontoTuristico->validate(['tm_idTipoMonumento']));

        //Estilo de Construção

        $pontoTuristico->ec_idEstiloConstrucao = Estiloconstrucao::findOne(['descricao' => 'Barroco'])->idEstiloConstrucao;
        $this->assertTrue($pontoTuristico->validate(['ec_idEstiloConstrucao']));

        //Localidade

        $pontoTuristico->localidade_idLocalidade = Localidade::findOne(['nomeLocalidade' => 'Leiria'])->id_localidade;
        $this->assertTrue($pontoTuristico->validate(['localidade_idLocalidade']));

        //Horário

        $pontoTuristico->horario = null;
        $this->assertTrue($pontoTuristico->validate(['horario']));

        $pontoTuristico->horario = '09:00h - 17:00h';
        $this->assertTrue($pontoTuristico->validate(['horario']));

        //Morada

        $pontoTuristico->morada = null;
        $this->assertTrue($pontoTuristico->validate(['morada']));

        $pontoTuristico->morada = 'Rua C, nº50';
        $this->assertTrue($pontoTuristico->validate(['morada']));

        //Telefone

        $pontoTuristico->telefone = null;
        $this->assertTrue($pontoTuristico->validate(['telefone']));

        $pontoTuristico->telefone = '924639852';
        $this->assertTrue($pontoTuristico->validate(['telefone']));

        //Latitude

        $pontoTuristico->latitude = null;
        $this->assertFalse($pontoTuristico->validate(['latitude']));

        $pontoTuristico->latitude = '39.74362';
        $this->assertTrue($pontoTuristico->validate(['latitude']));

        //Longitude

        $pontoTuristico->longitude = null;
        $this->assertFalse($pontoTuristico->validate(['longitude']));

        $pontoTuristico->longitude = '-8.80705';
        $this->assertTrue($pontoTuristico->validate(['longitude']));

    }

    public function testCriarPontoTuristico()
    {
        $pontoTuristico = new Pontosturisticos();

        $tipoMonumento = Tipomonumento::findOne(['descricao' => 'Castelo'])->idTipoMonumento;
        $estiloConstrucao = Estiloconstrucao::findOne(['descricao' => 'Barroco'])->idEstiloConstrucao;
        $localidade = Localidade::findOne(['nomeLocalidade' => 'Leiria'])->id_localidade;

        $pontoTuristico->nome = "Castelo";
        $pontoTuristico->anoConstrucao = "1000";
        $pontoTuristico->descricao = "Em Leiria";
        $pontoTuristico->foto = "castelo-de-leiria.jpg";
        $pontoTuristico->tm_idTipoMonumento = $tipoMonumento;
        $pontoTuristico->ec_idEstiloConstrucao = $estiloConstrucao;
        $pontoTuristico->localidade_idLocalidade = $localidade;
        $pontoTuristico->latitude = '39.74362';
        $pontoTuristico->longitude = '-8.80705';
        $pontoTuristico->status = 0;

        $pontoTuristico->save(false);

        $this->tester->seeInDatabase('pontosturisticos', ['nome' => 'Castelo', 'anoConstrucao' => '1000', 'descricao' => 'Em Leiria']);
    }

    public function testAtualizarPontoTuristico()
    {
        $pontoTuristico = $this->tester->grabRecord('common\models\Pontosturisticos', array('nome' => 'Castelo'));

        $pontoTuristico->nome = 'Castelo Leiria';
        $pontoTuristico->anoConstrucao = 1250;
        $pontoTuristico->descricao = "Em Leiria";
        $pontoTuristico->save(false);

        $this->tester->seeInDatabase('pontosturisticos', ['nome' => 'Castelo Leiria']);
    }

    public function testApagarPontoTuristico()
    {
        $pontoTuristico = $this->tester->grabRecord('common\models\Pontosturisticos', array('nome' => 'Castelo Leiria'));

        $pontoTuristico->delete();

        $this->tester->dontSeeInDatabase('pontosturisticos', ['nome' => 'Castelo Leiria']);

    }

}