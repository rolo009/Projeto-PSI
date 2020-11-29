<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ratings".
 *
 * @property int $id_rating
 * @property int $classificacao
 * @property int $pt_idPontoTuristico
 * @property int $user_idUtilizador
 */
class Ratings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classificacao', 'pt_idPontoTuristico', 'user_idUtilizador'], 'required'],
            [['classificacao', 'pt_idPontoTuristico', 'user_idUtilizador'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_rating' => 'Id Rating',
            'classificacao' => 'Classificacao',
            'pt_idPontoTuristico' => 'Pt Id Ponto Turistico',
            'user_idUtilizador' => 'User Id Utilizador',
        ];
    }
}
