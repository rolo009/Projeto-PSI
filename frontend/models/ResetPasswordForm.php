<?php
namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    
    public $oldPassword;
    public $newPassword;
    public $confirmNewPassword;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['oldPassword', 'required'],
            ['oldPassword', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['newPassword', 'required'],
            ['newPassword', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['confirmNewPassword', 'required'],
            ['confirmNewPassword', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $this->_user;
        $user->setPassword($this->oldPassword->password);
        $user->setPassword($this->newPassword);
        $user->setPassword($this->confirmNewPassword);

        return $user->save();
    }
}