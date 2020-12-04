<?php namespace frontend\tests;

use app\models\Userprofile;
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

        $user = new User();
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

        //Nome de Utilizador

        $user->username = null;
        $this->assertFalse($user->validate(['username']));

        $user->username = 'rolo009';
        $this->assertTrue($user->validate(['username']));

        //Email

        $user->email = 'pedro123';
        $this->assertFalse($user->validate(['email']));

        $user->email = null;
        $this->assertFalse($user->validate(['email']));

        $user->email = 'pedro123@gmail.com';
        $this->assertTrue($user->validate(['email']));

        //Password

        $user->password = $user->setPassword(null);
        $this->assertFalse($user->validate(['password']));

        $user->password = $user->setPassword('123');
        $this->assertFalse($user->validate(['password']));

        $user->password = $user->setPassword('123456789');
        $this->assertTrue($user->validate(['password']));

        //Data de Nascimento

        $userProfile->dtaNascimento = null;
        $this->assertFalse($userProfile->validate(['dtaNascimento']));

        $userProfile->dtaNascimento = 'Data';
        $this->assertFalse($userProfile->validate(['dtaNascimento']));

        $userProfile->dtaNascimento = 25658642;
        $this->assertFalse($userProfile->validate(['dtaNascimento']));

        $userProfile->dtaNascimento = '2020-11-02';
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

        //Sexo

        $userProfile->sexo = null;
        $this->assertFalse($userProfile->validate(['sexo']));

        $userProfile->sexo = 'Masculino';
        $this->assertTrue($userProfile->validate(['sexo']));

    }

    public function testCriarUtilizador()
    {
        $user = new User();
        $userProfile = new Userprofile();

        $user->username = 'rolo009';
        $user->email = 'pedrorolo@gmail.com';
        $user->setPassword('pedro123456789');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $userProfile->primeiroNome = 'Pedro';
        $userProfile->ultimoNome = 'Rolo';
        $userProfile->dtaNascimento = 2000-01-13;
        $userProfile->morada = 'Rua A';
        $userProfile->localidade = 'Vila Viçosa';
        $userProfile->sexo = 'Masculino';
        $user->save();
        $userProfile->id_user_rbac = $user->getId();

        $userProfile->save();
        $this->tester->seeInDatabase('user', ['username' => 'rolo009', 'email' => 'pedrorolo@gmail.com']);
        $this->tester->seeInDatabase('userprofile', ['id_user_rbac' => $user->getId(), 'primeiroNome' => 'Pedro', 'ultimoNome' => 'Rolo']);
    }

    public function testAtualizarUtilizador()
    {
        $user = $this->tester->grabRecord('app\common\models\User', array('email' => 'pedrorolo@gmail.com'));
        $userprofile = $this->tester->grabRecord('app\models\User', array('id_user_rbac' => $user->id));

        $user->username = "pedrorolo009";
        $userprofile->localidade = "Leiria";
        $user->save();
        $userprofile->save();

        $this->tester->seeInDatabase('user', ['username' => 'pedrorolo009']);
        $this->tester->seeInDatabase('userprofile', ['localidade' => 'Leiria']);
    }

    public function testApagarPessoa()
    {
        $user = $this->tester->grabRecord('app\common\models\User', array('email' => 'pedrorolo@gmail.com'));
        $userprofile = $this->tester->grabRecord('app\models\User', array('id_user_rbac' => $user->id));

        $userprofile->delete();

        $this->tester->seeInDatabase('userprofile', ['id_user_rbac' => $user->id]);

        $user->delete();

        $this->tester->seeInDatabase('user', ['username' => 'pedrorolo009']);

    }

}