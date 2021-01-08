<?php namespace frontend\tests;

use common\models\Localidade;

class LocalidadeTest extends \Codeception\Test\Unit
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
    public function testProcurarLocalidade()
    {
        $localidade = new Localidade();

        $localidade ->nomeLocalidade= null;
        $this->assertFalse($localidade->validate(['nomeLocalidade']));

        $localidade ->nomeLocalidade= 'Leiria';
        $this->assertTrue($localidade->validate('nomeLocalidade'));

        $localidade ->foto= null;
        $this->assertFalse($localidade->validate(['foto']));

        $localidade ->foto= 'Leiria.jpg';
        $this->assertTrue($localidade->validate('foto'));
    }

    public function testCriarLocalidade(){
        $localidade = new Localidade();

        $localidade-> nomeLocalidade = 'Leiria';

        $localidade-> foto = 'Leiria.jpg';

        $localidade->save();

        $this->tester->seeInDatabase('localidade',['nomeLocalidade'=>'Leiria', 'foto'=>'Leiria.jpg']);

    }
}