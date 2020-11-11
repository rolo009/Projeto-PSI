<?php

namespace app\models;

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
            'primeiroNome' => 'Primeiro Nome',
            'ultimoNome' => 'Ultimo Nome',
            'dtaNascimento' => 'Dta Nascimento',
            'morada' => 'Morada',
            'localidade' => 'Localidade',
            'sexo' => 'Sexo',
            'id_user_rbac' => 'Id User Rbac',
        ];
    }
}
