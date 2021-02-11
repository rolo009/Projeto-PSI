<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage('/Projeto-Final-PSI/frontend/web');
        $I->wait(3); // wait for page to be opened

        $I->seeLink('SOBRE NÓS');
        $I->click('SOBRE NÓS');
        $I->wait(2); // wait for page to be opened

        $I->see('A Nossa Equipa');
    }
}
