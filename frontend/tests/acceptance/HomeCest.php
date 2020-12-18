<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/cultravel/index'));
        $I->see('Procurar');

        $I->seeLink('Sobre Nós');
        $I->click('Sobre Nós');
        $I->wait(2); // wait for page to be opened

        $I->see('A Nossa Equipa');
    }
}
