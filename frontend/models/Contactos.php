<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "contactos".
 *
 * @property int $idContactos
 * @property string $nome
 * @property string $email
 * @property string $assunto
 * @property string $mensagem
 * @property string|null $data
 * @property int $id_user_rbac
 *
 * @property User $userRbac
 */
class Contactos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contactos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'assunto', 'mensagem', 'id_user_rbac'], 'required'],
            [['data'], 'safe'],
            [['id_user_rbac'], 'integer'],
            [['nome', 'email'], 'string', 'max' => 255],
            [['assunto'], 'string', 'max' => 60],
            [['mensagem'], 'string', 'max' => 6000],
            [['id_user_rbac'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user_rbac' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idContactos' => 'Id Contactos',
            'nome' => 'Nome',
            'email' => 'Email',
            'assunto' => 'Assunto',
            'mensagem' => 'Mensagem',
            'data' => 'Data',
            'id_user_rbac' => 'Id User Rbac',
        ];
    }

    /**
     * Gets query for [[UserRbac]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserRbac()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user_rbac']);
    }
}
