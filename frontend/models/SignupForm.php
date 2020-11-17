<?php
namespace frontend\models;

use app\models\Userprofile;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $primeiroNome;
    public $ultimoNome;
    public $dtaNascimento;
    public $morada;
    public $localidade;
    //public $sexo;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['primeiroNome', 'required'],
            ['primeiroNome', 'string', 'max' => 255],

            ['ultimoNome', 'required'],
            ['ultimoNome', 'string', 'max' => 255],

            ['dtaNascimento', 'required'],
            ['dtaNascimento', 'date'],

            ['morada', 'required'],
            ['morada', 'string', 'max' => 255],

            ['localidade', 'required'],
            ['localidade', 'string', 'max' => 255],

            //['$sexo', 'string', 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $userProfile = new Userprofile();

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $userProfile->primeiroNome = $this->primeiroNome;
        $userProfile->ultimoNome = $this->ultimoNome;
        $userProfile->dtaNascimento = $this->dtaNascimento;
        $userProfile->morada = $this->morada;
        $userProfile->localidade = $this->localidade;
        $userProfile->sexo = 'Masculino';
        $userProfile->id_user_rbac = 1;

        return $user->save() && $this->sendEmail($user) && $userProfile->save();

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
