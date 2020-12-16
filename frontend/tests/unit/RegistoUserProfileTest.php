<?php namespace frontend\tests;

use common\models\User;
use common\models\Userprofile;

class RegistoUserProfileTest extends \Codeception\Test\Unit
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

        codecept_debug('-----');
        codecept_debug(date('Y-m-d'));
        codecept_debug('-----');

        $userProfile->dtaNascimento = date('Y-m-d H:i:s');
        $this->assertTrue($userProfile->validate(['dtaNascimento']));

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

        //Distrito
        $userProfile->distrito = null;
        $this->assertFalse($userProfile->validate(['distrito']));

        $userProfile->localidade = 'Évora';
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

        $userProfile->primeiroNome = 'Teste';
        $userProfile->ultimoNome = 'Registo';
        $userProfile->dtaNascimento = date('Y-m-d H:i:s');
        $userProfile->morada = 'Rua A';
        $userProfile->localidade = 'Vila Viçosa';
        $userProfile->distrito= 'Évora';
        $userProfile->sexo = 'Masculino';

        $user = User::findOne(['username' => 'test_registo']);

        $userProfile->id_user_rbac = $user->id;

        $userProfile->save(false);
        $this->tester->seeInDatabase('userprofile', ['id_user_rbac' => $user->getId(), 'primeiroNome' => 'Teste', 'ultimoNome' => 'Registo']);
    }

    public function testAtualizarUtilizador()
    {
        $user = $this->tester->grabRecord('common\models\User', array('email' => 'test_registo@live.com.pt'));
        $userprofile = $this->tester->grabRecord('common\models\Userprofile', array('id_user_rbac' => $user->id));

        $userprofile->localidade = "Leiria";
        $user->save();
        $userprofile->save();

        $this->tester->seeInDatabase('userprofile', ['localidade' => 'Leiria']);
    }

    public function testApagarPessoa()
    {
        $user = $this->tester->grabRecord('common\models\User', array('email' => 'test_registo@live.com.pt'));
        $userprofile = $this->tester->grabRecord('common\models\Userprofile', array('id_user_rbac' => $user->id));

        $userprofile->delete();

        $this->tester->seeInDatabase('userprofile', ['id_user_rbac' => $user->id]);

    }

}