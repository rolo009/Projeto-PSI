<?php namespace common\tests;

use common\models\Userprofile;
use common\models\User;

class RegistoTest extends \Codeception\Test\Unit
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
     * Teste Unitário Registo
     */

    public function testValidacaoPessoa(){

        $userProfile = new Userprofile();

        //Despoletar todas as regras de validação

        //Primeiro Nome
        $userProfile->primeiroNome = null;
        $this->assertFalse($userProfile->validate(['primeiroNome']));

        $userProfile->primeiroNome = 'Pedro';
        $this->assertTrue($userProfile->validate(['primeiroNome']));

        //Último Nome

        $userProfile->ultimoNome = null;
        $this->assertFalse($userProfile->validate(['ultimoNome']));

        $userProfile->ultimoNome = 'Rolo';
        $this->assertTrue($userProfile->validate(['ultimoNome']));

        //Data de Nascimento

        $userProfile->dtaNascimento = null;
        $this->assertFalse($userProfile->validate(['dtaNascimento']));

        $userProfile->dtaNascimento = 'Data';
        $this->assertFalse($userProfile->validate(['dtaNascimento']));

        $userProfile->dtaNascimento = 25658642;
        $this->assertFalse($userProfile->validate(['dtaNascimento']));

        $userProfile->dtaNascimento = date('yyyy-MM-dd');
        $this->assertFalse($userProfile->validate(['dtaNascimento']));

        //Morada

        $userProfile->morada = null;
        $this->assertFalse($userProfile->validate(['morada']));

        $userProfile->morada = 'Rua A';
        $this->assertTrue($userProfile->validate(['morada']));

        //Localidade

        $userProfile->localidade = null;
        $this->assertFalse($userProfile->validate(['localidade']));

        $userProfile->localidade = 'Vila Viçosa';
        $this->assertTrue($userProfile->validate(['localidade']));

        //Sexo

        $userProfile->sexo = null;
        $this->assertFalse($userProfile->validate(['sexo']));

        $userProfile->sexo = 'Masculino';
        $this->assertTrue($userProfile->validate(['sexo']));
    }

    public function testCriarUtilizador()
    {
        $userProfile = new Userprofile();

        $userProfile->primeiroNome = 'Pedro';
        $userProfile->ultimoNome = 'Rolo';
        $userProfile->dtaNascimento = date('Y-m-d');
        $userProfile->morada = 'Rua A';
        $userProfile->distrito = 'Évora';
        $userProfile->localidade = 'Vila Viçosa';
        $userProfile->sexo = 'Masculino';

        $user = User::findOne(['username' => 'test_registo']);

        $userProfile->id_user_rbac = $user->id;

        $userProfile->save(false);
        $this->tester->seeInDatabase('userprofile', ['id_user_rbac' => $user->getId(), 'primeiroNome' => 'Pedro', 'ultimoNome' => 'Rolo']);
    }

    public function testAtualizarUtilizador()
    {
        $userprofile = $this->tester->grabRecord(Userprofile::class, array('primeiroNome' => 'Pedro', 'ultimoNome' => 'Rolo'));

        $userprofile->localidade = "Leiria";
        $userprofile->save(false);

        $this->tester->seeInDatabase('userprofile', ['localidade' => 'Leiria']);
    }

    public function testApagarPessoa()
    {
        $userprofile = $this->tester->grabRecord(Userprofile::class, array('primeiroNome' => 'Pedro', 'ultimoNome' => 'Rolo'));

        $userprofile->delete();

        $this->tester->dontSeeInDatabase('userprofile', ['primeiroNome' => 'Pedro']);

    }

}