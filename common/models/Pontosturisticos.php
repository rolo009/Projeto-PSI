<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pontosturisticos".
 *
 * @property int $id_pontoTuristico
 * @property string $nome
 * @property string $anoConstrucao
 * @property string $descricao
 * @property string $foto
 * @property int $tm_idTipoMonumento
 * @property int $ec_idEstiloConstrucao
 * @property int $localidade_idLocalidade
 * @property int $status
 * @property string $latitude
 * @property string $longitude
 */
class Pontosturisticos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pontosturisticos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'anoConstrucao', 'descricao', 'foto', 'tm_idTipoMonumento', 'ec_idEstiloConstrucao', 'localidade_idLocalidade', 'status', 'latitude', 'longitude'], 'required'],
            [['tm_idTipoMonumento', 'ec_idEstiloConstrucao', 'localidade_idLocalidade', 'status'], 'integer'],
            [['nome', 'anoConstrucao', 'foto', 'latitude', 'longitude'], 'string', 'max' => 255],
            [['descricao'], 'string', 'max' => 6000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pontoTuristico' => 'Id Ponto Turistico',
            'nome' => 'Nome',
            'anoConstrucao' => 'Ano Construcao',
            'descricao' => 'Descricao',
            'foto' => 'Foto',
            'tm_idTipoMonumento' => 'Tm Id Tipo Monumento',
            'ec_idEstiloConstrucao' => 'Ec Id Estilo Construcao',
            'localidade_idLocalidade' => 'Localidade Id Localidade',
            'status' => 'Status',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
}
