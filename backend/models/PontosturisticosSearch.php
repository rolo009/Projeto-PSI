<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pontosturisticos;

/**
 * PontosturisticosSearch represents the model behind the search form of `app\models\pontosturisticos`.
 */
class PontosturisticosSearch extends Pontosturisticos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pontoTuristico', 'tm_idTipoMonumento', 'ec_idEstiloConstrucao', 'localidade_idLocalidade'], 'integer'],
            [['nome', 'anoConstrucao', 'descricao', 'foto'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pontosturisticos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_pontoTuristico' => $this->id_pontoTuristico,
            'tm_idTipoMonumento' => $this->tm_idTipoMonumento,
            'ec_idEstiloConstrucao' => $this->ec_idEstiloConstrucao,
            'localidade_idLocalidade' => $this->localidade_idLocalidade,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'anoConstrucao', $this->anoConstrucao])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'foto', $this->foto]);

        return $dataProvider;
    }
}
