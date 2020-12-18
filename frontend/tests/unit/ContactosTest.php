<?php namespace frontend\tests;

use app\models\ContactForm;
use common\models\Contactos;


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

        $contactos->nome = 'Mario';
        $this->assertTrue($contactos->validate(['nome']));

        //Email
        $contactos->email = 'mariofcc271999';
        $this->assertFalse($contactos->validate(['email']));

        $contactos->email = null;
        $this->assertFalse($contactos->validate(['email']));

        $contactos->email = 'mariofcc271999@gmail.com';
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

        $contactos->nome = 'Mario';
        $contactos->email = 'mariofcc271999@gmail.com';
        $contactos->assunto = 'Isto é um teste no campo assunto';
        $contactos->mensagem = 'Isto é um teste no campo mensagem';
        $contactos->status = 0;
        $contactos->save();

        $this->tester->seeInDatabase('contactos', ['nome' => 'Mario', 'email' => 'mariofcc271999@gmail.com','assunto'=>'Isto é um teste no campo assunto','messagem'=>'Isto é um teste no campo mensagem','status'=>'0']);


    }
}