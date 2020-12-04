<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "localidade".
 *
 * @property int $id_localidade
 * @property string $nomeLocalidade
 *
 * @property Pontosturisticos[] $pontosturisticos
 */
class Localidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomeLocalidade'], 'required', 'message'=>'O campo Localidade não pode estar em branco!'],
            [['nomeLocalidade'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_localidade' => 'Id Localidade',
            'nomeLocalidade' => 'Nome Localidade',
        ];
    }

    /**
     * Gets query for [[pontosturisticos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPontosturisticos()
    {
        return $this->hasMany(Pontosturisticos::className(), ['localidade_idLocalidade' => 'id_localidade']);
    }
}
