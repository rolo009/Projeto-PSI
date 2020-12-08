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
    public $newpassword;
    public $newPasswordConfirm;


    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            [['newPassword','oldPassword', 'newPasswordConfirm'], 'required'],
            [['oldPassword'], 'validateOldPassword'],

            [['newPassword', 'newPasswordConfirm'], 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            [['newPassword', 'newPasswordConfirm'], 'filter', 'filter' => 'trim'],
            [['newPasswordConfirm'], 'compare', 'compareAtributte' => 'newPassword', 'messagem' => 'As palavras-passes não coicidem!'],
        ];
    }

    public function validateOldPassword()
    {
        if (!$this->verificaPassword($this->oldPassword)) {
            $this->addError("oldPassword", "Password atual incorreta!");
        }
    }

    public function verificaPassword($password)
    {
        $dbpassword = static::findOne(['username' => Yii::$app->user->identity->username, 'status' => self::STATUS_ACTIVE])->password_hash;
        return Yii::$app->security->validatePassword($password, $dbpassword);
    }

    public static function findIdentity($idUser)
    {
        return static::findOne(['id' => $idUser, 'status' => self::STATUS_ACTIVE]);
    }

    public function attributeLabels(){
        return [
            'oldPassword'=>'Old Password',
            'newPassword'=>'New Password',
            'newPasswordConfirm'=>'Repeat New Password',
        ];
    }

}
