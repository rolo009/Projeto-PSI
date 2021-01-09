<?php namespace common\tests;

use common\models\Tipomonumento;

class TipoMonumentoTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testValidacaoTipoMonumento()
    {
        $tipomonumento = new Tipomonumento();

        //Despoletar todas as regras de validação

        //descrição
        $tipomonumento ->descricao= null;
        $this->assertFalse($tipomonumento->validate(['descricao']));

        $tipomonumento ->descricao= 'Museu';
        $this->assertTrue($tipomonumento->validate('descricao'));

    }
    public function testCriarTipoMonumento(){
        $tipomonumento = new Tipomonumento();

        $tipomonumento-> descricao = 'Museu';

        $tipomonumento->save();

        $this->tester->seeInDatabase('tipomonumento',['descricao'=>'Museu']);

    }


}