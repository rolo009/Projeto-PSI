<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {

    }
    
    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/cultravel/login');
        $I->fillField('LoginForm[email]', 'admin@admin.pt');
        $I->fillField('LoginForm[password]', 'admin123');
        $I->click('insert-login');
        $I->see('GERIR UTILIZADORES');
    }
}
