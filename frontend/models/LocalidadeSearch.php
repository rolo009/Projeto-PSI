<?php

namespace common\models;

use common\models\Localidade;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * LocalidadeSearch represents the model behind the search form of `app\models\Localidade`.
 */
class LocalidadeSearch extends Localidade
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_localidade'], 'integer'],
            [['nomeLocalidade'], 'safe'],
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
        $query = Localidade::find();

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
            'id_localidade' => $this->id_localidade,
        ]);

        $query->andFilterWhere(['like', 'nomeLocalidade', $this->nomeLocalidade]);

        return $dataProvider;
    }
}
