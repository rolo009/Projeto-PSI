<?php namespace frontend\tests;

use common\models\Contactos;
use frontend\models\ContactForm;


class ContactosTest extends \Codeception\Test\Unit
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
    /**
     * Teste Unitário Contactos
     */
    public function testValidacaoContatos()
    {
     $contactos = new Contactos();

        //Despoletar todas as regras de validação

        //Nome
        $contactos->nome = null;
        $this->assertFalse($contactos->validate(['nome']));

        $contactos->nome = 'Teste';
        $this->assertTrue($contactos->validate(['nome']));

        //Email
        $contactos->email = 'teste123';
        $this->assertFalse($contactos->validate(['email']));

        $contactos->email = null;
        $this->assertFalse($contactos->validate(['email']));

        $contactos->email = 'test123@gmail.com';
        $this->assertTrue($contactos->validate(['email']));

        //assunto
        $contactos->assunto = null;
        $this->assertFalse($contactos->validate(['assunto']));

        $contactos->assunto = 'Isto é um teste no campo assunto';
        $this->assertTrue($contactos->validate(['assunto']));

        //mensagem
        $contactos->mensagem = null;
        $this->assertFalse($contactos->validate(['mensagem']));

        $contactos->mensagem = 'Isto é um teste no campo mensagem';
        $this->assertTrue($contactos->validate(['mensagem']));

    }
    public function testCriarMensagem(){

        $contactos = new Contactos();

        $contactos->nome = 'Teste';
        $contactos->email = 'test123@gmail.com';
        $contactos->assunto = 'Isto é um teste no campo assunto';
        $contactos->mensagem = 'Isto é um teste no campo mensagem';
        $contactos->status = 0;
        $contactos->save(false);

        $this->tester->seeInDatabase('contactos', ['nome' => 'Teste', 'email' => 'test123@gmail.com','status'=>0]);

    }
}