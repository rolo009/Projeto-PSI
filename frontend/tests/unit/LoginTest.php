<?php namespace frontend\tests;

use common\models\User;

class LoginTest extends \Codeception\Test\Unit
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

        //Despoletar todas as regras de validação

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
    }

    public function testLoginUtilizador()
    {
        $user = new User();

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