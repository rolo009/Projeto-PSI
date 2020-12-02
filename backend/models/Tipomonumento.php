<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipomonumento".
 *
 * @property int $idTipoMonumento
 * @property string $descricao
 */
class Tipomonumento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipomonumento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTipoMonumento' => 'Id Tipo Monumento',
            'descricao' => 'Descricao',
        ];
    }
}