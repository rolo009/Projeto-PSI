<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

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
 */
class PontosturisticosSearch extends \yii\db\ActiveRecord
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
            [['nome', 'anoConstrucao', 'descricao', 'foto', 'tm_idTipoMonumento', 'ec_idEstiloConstrucao', 'localidade_idLocalidade'], 'required'],
            [['tm_idTipoMonumento', 'ec_idEstiloConstrucao', 'localidade_idLocalidade'], 'integer'],
            [['nome', 'anoConstrucao', 'descricao', 'foto'], 'string', 'max' => 255],
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
        ];
    }

    public function search($localidade){
        $localidadePT = Localidade::find()->where(['nomeLocalidade' => $localidade]);

        $pontosTuristicos = Pontosturisticos::find()->where(['localidade_idLocalidade' => 1]);


       return $pontosTuristicos;
    }

}
