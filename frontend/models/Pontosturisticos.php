<?php

namespace app\models;

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
 *
 * @property Favoritos[] $favoritos
 * @property Estiloconstrucao $ecIdEstiloConstrucao
 * @property Tipomonumento $tmIdTipoMonumento
 * @property Localidade $localidadeIdLocalidade
 * @property Ratings[] $ratings
 * @property Visitados[] $visitados
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
            [['nome'], 'required', 'message'=>'O campo Nome não pode estar em branco!'],
            [['anoConstrucao'], 'required', 'message'=>'O campo anoConstrucao não pode estar em branco!'],
            [['descricao'], 'required', 'message'=>'O campo Descricao não pode estar em branco!'],
            [['foto'], 'required', 'message'=>'O campo foto não pode estar em branco!'],
            [['tm_idTipoMonumento'], 'required', 'message'=>'O campo IDTipoMonumento não pode estar em branco!'],
            [['ec_idEstiloConstrucao'], 'required', 'message'=>'O campo IDEstiloConstrucao não pode estar em branco!'],
            [['localidade_idLocalidade'], 'required', 'message'=>'O campo IDLocalidade não pode estar em branco!'],
            [['tm_idTipoMonumento', 'ec_idEstiloConstrucao', 'localidade_idLocalidade'], 'integer'],
            [['nome', 'anoConstrucao', 'descricao', 'foto'], 'string', 'max' => 255],
            [['ec_idEstiloConstrucao'], 'exist', 'skipOnError' => true, 'targetClass' => Estiloconstrucao::className(), 'targetAttribute' => ['ec_idEstiloConstrucao' => 'idEstiloConstrucao']],
            [['tm_idTipoMonumento'], 'exist', 'skipOnError' => true, 'targetClass' => Tipomonumento::className(), 'targetAttribute' => ['tm_idTipoMonumento' => 'idTipoMonumento']],
            [['localidade_idLocalidade'], 'exist', 'skipOnError' => true, 'targetClass' => Localidade::className(), 'targetAttribute' => ['localidade_idLocalidade' => 'id_localidade']],
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
            'anoConstrucao' => 'Ano de Construcão',
            'descricao' => 'Descricao',
            'foto' => 'Foto',
            'tm_idTipoMonumento' => 'Tipo de Monumento',
            'ec_idEstiloConstrucao' => 'Estilo de Construcao',
            'localidade_idLocalidade' => 'Localidade',
        ];
    }

    /**
     * Gets query for [[Favoritos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favoritos::className(), ['pt_idPontoTuristico' => 'id_pontoTuristico']);
    }

    /**
     * Gets query for [[EcIdEstiloConstrucao]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEcIdEstiloConstrucao()
    {
        return $this->hasOne(Estiloconstrucao::className(), ['idEstiloConstrucao' => 'ec_idEstiloConstrucao']);
    }

    /**
     * Gets query for [[TmIdTipoMonumento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTmIdTipoMonumento()
    {
        return $this->hasOne(Tipomonumento::className(), ['idTipoMonumento' => 'tm_idTipoMonumento']);
    }

    /**
     * Gets query for [[LocalidadeIdLocalidade]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidadeIdLocalidade()
    {
        return $this->hasOne(Localidade::className(), ['id_localidade' => 'localidade_idLocalidade']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Ratings::className(), ['pt_idPontoTuristico' => 'id_pontoTuristico']);
    }

    /**
     * Gets query for [[Visitados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisitados()
    {
        return $this->hasMany(Visitados::className(), ['pt_idPontoTuristico' => 'id_pontoTuristico']);
    }
}
