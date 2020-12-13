<?php

namespace frontend\models;

use common\models\Contactos;
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

    const STATUS_NAO_LIDA = 0;

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
            [['nome'], 'required', 'message'=>'O campo Nome não pode estar em branco!'],
            [['email'], 'required', 'message'=>'O campo Email não pode estar em branco!'],
            [['assunto'], 'required', 'message'=>'O campo Assunto não pode estar em branco!'],
            [['messagem'], 'required', 'message'=>'O campo Messagem não pode estar em branco!'],
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
            'verifyCode' => 'Codigo De Verificação',
        ];
    }

    public function saveContacto()
    {

        $contactos = new Contactos();

        $contactos->nome = $this->nome;
        $contactos->email = $this->email;
        $contactos->assunto = $this->assunto;
        $contactos->mensagem = $this->mensagem;
        $contactos->status = self::STATUS_NAO_LIDA;
        $contactos->save();

        if($contactos->save() == true){
            return true;
        }
        else{
            return false;
        }
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
