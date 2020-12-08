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
    public $password;
    public $novaPassword;
    public $confirmNovaPassword;


    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message'=>'O Palavra-Passe atual não pode estar em branco!'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['novaPassword', 'required', 'message'=>'O campo Nova Palavra-Passe não pode estar em branco!'],
            ['novaPassword', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['confirmNovaPassword', 'required', 'message'=>'O campo Confirmar Nova Palavra-Passe não pode estar em branco!'],
            ['confirmNovaPassword', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    /*public function resetPassword($new_password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($new_password);
        /*if (!$this->validate()) {
            return null;
        }

        $user = new User();

        $user->setPassword($this->password);

        return $user->save();
    }*/
    public function findPasswords($attribute, $params){
        $user = User::find()->where([
            'username'=>Yii::$app->user->identity->username
        ])->one();
        $password = $user->password;
        if($password!=$this->oldpass)
            $this->addError($attribute,'Old password is incorrect');
    }

    public function attributeLabels(){
        return [
            'password'=>'Old Password',
            'novaPassword'=>'New Password',
            'confirmNovaPassword'=>'Repeat New Password',
        ];
    }

}
