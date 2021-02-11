<?php namespace common\tests;

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

        $localidade ->nomeLocalidade= 'Beja';
        $this->assertTrue($localidade->validate('nomeLocalidade'));

        $localidade ->foto= null;
        $this->assertFalse($localidade->validate(['foto']));

        $localidade ->foto= 'Beja.jpg';
        $this->assertTrue($localidade->validate('foto'));
    }

    public function testCriarLocalidade(){
        $localidade = new Localidade();

        $localidade-> nomeLocalidade = 'Beja';

        $localidade-> foto = 'Beja.jpg';

        $localidade->save();

        $this->tester->seeInDatabase('localidade',['nomeLocalidade'=>'Beja', 'foto'=>'Beja.jpg']);

    }

    public function testAtualizarLocalidade()
    {
        $userprofile = $this->tester->grabRecord(Localidade::class, array('nomeLocalidade' => 'Beja', 'foto' => 'Beja.jpg'));

        $userprofile->foto = "Beja-cidade.jpg";
        $userprofile->save(false);

        $this->tester->seeInDatabase('localidade', ['foto' => 'Beja-cidade.jpg']);
    }

    public function testApagarLocalidade()
    {
        $userprofile = $this->tester->grabRecord(Localidade::class, array('nomeLocalidade' => 'Beja', 'foto' => 'Beja-cidade.jpg'));

        $userprofile->delete();

        $this->tester->dontSeeInDatabase('localidade', ['nomeLocalidade' => 'Beja', 'foto' => 'Beja-cidade.jpg']);

    }
}