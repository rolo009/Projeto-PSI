<?php

namespace frontend\tests\functional;
use common\models\User;
use frontend\tests\FunctionalTester;

class RegistoCest
{

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('cultravel/registar');
    }


    public function RegistoCorreto(FunctionalTester $I)
    {
        $I->submitForm('#registoForm', [
            'SignupForm[primeiroNome]' => 'Teste',
            'SignupForm[ultimoNome]' => 'Registo',
            'SignupForm[username]' => 'teste_registo123',
            'SignupForm[email]' => 'teste_registo@hotmail.com',
            'SignupForm[dtaNascimento]' => '2020-11-02',
            'SignupForm[password]' => '123456789',
            'SignupForm[confirmPassword]' => '123456789',
            'SignupForm[morada]' => 'Rua A',
            'SignupForm[localidade]' => 'Vila Viçosa',
            'SignupForm[distrito]' => 'Évora',
            'SignupForm[sexo]' => 'Masculino'
            ]);

        $I->see("Bem Vindo");

        $I->seeRecord(User::className(), [
            'username' => 'teste_registo123',
            'email' => 'teste_registo@hotmail.com',
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $I->seeRecord('common\models\Userprofile', [
            'primeiroNome' => 'Teste',
            'localidade' => 'Vila Viçosa',
        ]);
    }
}
