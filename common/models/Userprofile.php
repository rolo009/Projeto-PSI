<?php

namespace common\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "userprofile".
 *
 * @property int $id_userProfile
 * @property string $primeiroNome
 * @property string $ultimoNome
 * @property string $dtaNascimento
 * @property string $morada
 * @property string $localidade
 * @property string $distrito
 * @property string $sexo
 * @property int $id_user_rbac
 *
 * @property User $userRbac
 */
class Userprofile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userprofile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['primeiroNome', 'ultimoNome', 'dtaNascimento', 'morada', 'localidade','distrito', 'sexo', 'id_user_rbac'], 'required'],
            [['primeiroNome'], 'required', 'message'=>'O campo primeiroNome não pode estar em branco!'],
            [['ultimoNome'], 'required', 'message'=>'O campo ultimoNome não pode estar em branco!'],
            [['dtaNascimento'], 'required', 'message'=>'O campo dtaNascimento não pode estar em branco!'],
            [['morada'], 'required', 'message'=>'O campo morada não pode estar em branco!'],
            [['localidade'], 'required', 'message'=>'O campo localidade não pode estar em branco!'],
            [['distrito'], 'required', 'message'=>'O campo distrito não pode estar em branco!'],
            [['sexo'], 'required', 'message'=>'O campo sexo não pode estar em branco!'],
            [['id_user_rbac'], 'required', 'message'=>'O campo id_user_rbac não pode estar em branco!'],
            [['dtaNascimento'], 'safe'],
            [['dtaNascimento'], 'date'],
            [['id_user_rbac'], 'integer'],
            [['primeiroNome', 'ultimoNome', 'morada', 'localidade', 'sexo'], 'string', 'max' => 255],
            [['id_user_rbac'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user_rbac' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_userProfile' => 'Id User Profile',
            'primeiroNome' => 'Primeiro Nome',
            'ultimoNome' => 'Ultimo Nome',
            'dtaNascimento' => 'Dta Nascimento',
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'distrito'=>'distrito',
            'sexo' => 'Sexo',
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
