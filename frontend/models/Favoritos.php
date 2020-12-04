<?php

namespace app\models;

use common\models\User;
use Yii;

/**
 * This is the model class for table "favoritos".
 *
 * @property int $id_favoritos
 * @property int $pt_idPontoTuristico
 * @property int $user_idUtilizador
 *
 * @property Pontosturisticos $ptIdPontoTuristico
 * @property User $userIdUtilizador
 */
class Favoritos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favoritos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pt_idPontoTuristico', 'user_idUtilizador'], 'required'],
            [['pt_idPontoTuristico'], 'required', 'message'=>'O campo IDPontoTuristico não pode estar em branco!'],
            [['user_idUtilizador'], 'required', 'message'=>'O campo IDUtilizador não pode estar em branco!'],
            [['pt_idPontoTuristico', 'user_idUtilizador'], 'integer'],
            [['pt_idPontoTuristico'], 'exist', 'skipOnError' => true, 'targetClass' => Pontosturisticos::className(), 'targetAttribute' => ['pt_idPontoTuristico' => 'id_pontoTuristico']],
            [['user_idUtilizador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_idUtilizador' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_favoritos' => 'Id Favoritos',
            'pt_idPontoTuristico' => 'Pt Id Ponto Turistico',
            'user_idUtilizador' => 'User Id Utilizador',
        ];
    }

    /**
     * Gets query for [[PtIdPontoTuristico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPtIdPontoTuristico()
    {
        return $this->hasOne(Pontosturisticos::className(), ['id_pontoTuristico' => 'pt_idPontoTuristico']);
    }

    /**
     * Gets query for [[UserIdUtilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdUtilizador()
    {
        return $this->hasOne(User::className(), ['id' => 'user_idUtilizador']);
    }
}
