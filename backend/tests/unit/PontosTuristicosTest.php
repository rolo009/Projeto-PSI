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
        $this->assertFalse($pontoTuristico->validate(['anoConstrucao']));

        $pontoTuristico->anoConstrucao = '1135';
        $this->assertTrue($pontoTuristico->validate(['anoConstrucao']));

        //Descrição

        $pontoTuristico->descricao = null;
        $this->assertFalse($pontoTuristico->validate(['descricao']));

        $pontoTuristico->descricao = 'Localizado em Leiria';
        $this->assertTrue($pontoTuristico->validate(['descricao']));

        //Foto

        $pontoTuristico->foto = null;
        $this->assertFalse($pontoTuristico->validate(['foto']));

        $pontoTuristico->foto = 'castelo-de-leiria.jpg';
        $this->assertTrue($pontoTuristico->validate(['foto']));

        //Tipo de Monumento

        $pontoTuristico->tm_idTipoMonumento = null;
        $this->assertFalse($pontoTuristico->validate(['tm_idTipoMonumento']));

        $pontoTuristico->tm_idTipoMonumento = Tipomonumento::findOne(['descricao' => 'Castelo'])->idTipoMonumento;
        $this->assertTrue($pontoTuristico->validate(['tm_idTipoMonumento']));

        //Estilo de Construção

        $pontoTuristico->ec_idEstiloConstrucao = null;
        $this->assertFalse($pontoTuristico->validate(['ec_idEstiloConstrucao']));

        $pontoTuristico->ec_idEstiloConstrucao = Estiloconstrucao::findOne(['descricao' => 'Barroco'])->idEstiloConstrucao;
        $this->assertTrue($pontoTuristico->validate(['ec_idEstiloConstrucao']));

        //Localidade

        $pontoTuristico->localidade_idLocalidade = null;
        $this->assertFalse($pontoTuristico->validate(['localidade_idLocalidade']));

        $pontoTuristico->localidade_idLocalidade = Localidade::findOne(['nomeLocalidade' => 'Leiria'])->id_localidade;
        $this->assertTrue($pontoTuristico->validate(['localidade_idLocalidade']));

    }

    public function testCriarPontoTuristico()
    {
        $pontoTuristico = new Pontosturisticos();

        $tipoMonumento = Tipomonumento::findOne(['descricao' => 'Castelo'])->idTipoMonumento;
        $estiloConstrucao = Estiloconstrucao::findOne(['descricao' => 'Barroco'])->idEstiloConstrucao;
        $localidade = Localidade::findOne(['nomeLocalidade' => 'Leiria'])->id_localidade;

        $pontoTuristico->nome = "Castelo de Leiria";
        $pontoTuristico->anoConstrucao = "1135";
        $pontoTuristico->descricao = "Localizado em Leiria";
        $pontoTuristico->foto = "castelo-de-leiria.jpg";
        $pontoTuristico->tm_idTipoMonumento = $tipoMonumento;
        $pontoTuristico->ec_idEstiloConstrucao = $estiloConstrucao;
        $pontoTuristico->localidade_idLocalidade = $localidade;

        $pontoTuristico->save();
        $this->assertTrue($pontoTuristico->save());
        codecept_debug('----');
        codecept_debug(Pontosturisticos::find()->all());
        codecept_debug('----');

        $this->tester->seeInDatabase('pontosturisticos', ['nome' => 'Castelo de Leiria', 'anoConstrucao' => '1135', 'descricao' => 'Localizado em Leiria', 'foto' => 'castelo-de-leiria.jpg']);
    }

    public function testAtualizarPontoTuristico()
    {
        $pontoTuristico = $this->tester->grabRecord('common\models\Pontosturisticos', array('nome' => 'Castelo de Leiria'));

        $pontoTuristico->nome = 'Castelo Leiria';
        $pontoTuristico->anoConstrucao = 1250;
        $pontoTuristico->descricao = "Em Leiria";
        $pontoTuristico->save();

        $this->tester->seeInDatabase('pontosturisticos', ['nome' => 'Castelo Leiria']);
    }

    public function testApagarPontoTuristico()
    {
        $pontoTuristico = $this->tester->grabRecord('common\models\Pontosturisticos', array('nome' => 'Castelo Leiria'));

        $pontoTuristico->delete();

        $this->tester->seeInDatabase('pontosturisticos', ['nome' => 'Castelo Leiria']);

    }

}