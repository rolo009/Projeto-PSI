<?php

namespace frontend\models;

use app\models\Contactos;
use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $nome;
    public $email;
    public $assunto;
    public $mensagem;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contactos';
    }
    public function rules()
    {
        return [
            [['nome', 'email', 'assunto', 'mensagem'], 'required'],
            [['email', 'email'], 'required'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function saveContacto()
    {
        if (!$this->validate()) {
            return null;
        }

        $contactos = new Contactos();

        $contactos->nome = $this->nome;
        $contactos->email = $this->email;
        $contactos->assunto = $this->assunto;
        $contactos->mensagem = $this->mensagem;
        $contactos->save();

        VarDumper::dump($contactos->save());
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();

    }
}
