<?php

namespace common\models;

use common\models\Pontosturisticos;
use common\models\User;
use Yii;

/**
 * This is the model class for table "visitados".
 *
 * @property int $id_visitados
 * @property int $user_idUtilizador
 * @property int $pt_idPontoTuristico
 *
 * @property User $userIdUtilizador
 * @property Pontosturisticos $ptIdPontoTuristico
 */
class Visitados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visitados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_idUtilizador'], 'required', 'message'=>'O campo IDUtilizador não pode estar em branco!'],
            [['pt_idPontoTuristico'], 'required', 'message'=>'O campo IDPontoTuristico não pode estar em branco!'],
            [['user_idUtilizador', 'pt_idPontoTuristico'], 'integer'],
            [['user_idUtilizador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_idUtilizador' => 'id']],
            [['pt_idPontoTuristico'], 'exist', 'skipOnError' => true, 'targetClass' => Pontosturisticos::className(), 'targetAttribute' => ['pt_idPontoTuristico' => 'id_pontoTuristico']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_visitados' => 'Id Visitados',
            'user_idUtilizador' => 'User Id Utilizador',
            'pt_idPontoTuristico' => 'Pt Id Ponto Turistico',
        ];
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

    /**
     * Gets query for [[PtIdPontoTuristico]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPtIdPontoTuristico()
    {
        return $this->hasOne(Pontosturisticos::className(), ['id_pontoTuristico' => 'pt_idPontoTuristico']);
    }
}
