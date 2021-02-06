<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Contactos;

/**
 * ContactosSearch represents the model behind the search form of `app\models\Contactos`.
 */
class ContactosSearch extends Contactos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idContactos', 'status'], 'integer'],
            [['nome', 'email', 'assunto', 'mensagem', 'dataEnvioMensagem', 'dataResposta'], 'safe'],
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
        $query = Contactos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idContactos' => $this->idContactos,
            'dataEnvioMensagem' => $this->dataEnvioMensagem,
            'dataResposta' => $this->dataResposta,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'assunto', $this->assunto])
            ->andFilterWhere(['like', 'mensagem', $this->mensagem]);

        return $dataProvider;
    }
}
