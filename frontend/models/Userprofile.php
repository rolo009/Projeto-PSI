<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "userprofile".
 *
 * @property string $primeiroNome
 * @property string $ultimoNome
 * @property string $dtaNascimento
 * @property string $morada
 * @property string $localidade
 * @property string $sexo
 * @property int $id_user_rbac
 */
class Userprofile extends \yii\db\ActiveRecord
{
    public $verification_token;
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
            [['primeiroNome', 'ultimoNome', 'dtaNascimento', 'morada', 'localidade', 'sexo', 'id_user_rbac'], 'required'],
            [['primeiroNome'], 'required', 'message'=>'O campo PrimeiroNome não pode estar em branco!'],
            [['ultimoNome'], 'required', 'message'=>'O campo UltimoNome não pode estar em branco!'],
            [['dtaNascimento'], 'required', 'message'=>'O campo DataNascimento não pode estar em branco!'],
            [['morada'], 'required', 'message'=>'O campo Morada não pode estar em branco!'],
            [['localidade'], 'required', 'message'=>'O campo Localidade não pode estar em branco!'],
            [['sexo'], 'required', 'message'=>'O campo Sexo não pode estar em branco!'],
            [['id_user_rbac'], 'required', 'message'=>'O campo IDUserRBAc não pode estar em branco!'],
            [[''], 'required', 'message'=>'O campo  não pode estar em branco!'],
            [['dtaNascimento'], 'safe'],
            [['id_user_rbac'], 'integer'],
            [['primeiroNome', 'ultimoNome', 'morada', 'localidade', 'sexo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'primeiroNome' => 'Nome:',
            'ultimoNome' => 'Apelido:',
            'dtaNascimento' => 'Data de Nascimento:',
            'morada' => 'Morada:',
            'localidade' => 'Localidade:',
            'sexo' => 'Sexo:',
            'id_user_rbac' => 'Id User Rbac',
        ];
    }
}
