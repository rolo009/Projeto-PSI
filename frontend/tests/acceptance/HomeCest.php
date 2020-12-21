<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/cultravel/index'));
        $I->wait(100); // wait for page to be opened

        /*
        $I->see('CULTRAVEL');

        $I->seeLink('SOBRE NÓS');
        $I->click('SOBRE NÓS');
        $I->wait(2); // wait for page to be opened

        $I->see('A Nossa Equipa');*/
    }
}
