<?php

namespace api\modules\v1\controllers;

use common\models\Estiloconstrucao;
use common\models\Favoritos;
use common\models\Localidade;
use common\models\Pontosturisticos;
use common\models\Tipomonumento;
use common\models\Visitados;
use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;

class PontosturisticosController extends Activecontroller
{
    public $modelClass = 'common\models\Pontosturisticos';

    public function actionInfo()
    {
        $pontosTuristicosModel = new $this->modelClass;
        $pontosTuristicos = $pontosTuristicosModel::find()->where(['status' => 1])->all();
        if ($pontosTuristicos != null) {

            foreach ($pontosTuristicos as $pontoTuristico) {
                if ($pontoTuristico->tm_idTipoMonumento != null) {
                    $pontoTuristico->tm_idTipoMonumento = Tipomonumento::find()->where(['idTipoMonumento' => $pontoTuristico->tm_idTipoMonumento])->one()->descricao;
                }
                if ($pontoTuristico->ec_idEstiloConstrucao != null) {
                    $pontoTuristico->ec_idEstiloConstrucao = Estiloconstrucao::find()->where(['idEstiloConstrucao' => $pontoTuristico->ec_idEstiloConstrucao])->one()->descricao;
                }
                if ($pontoTuristico->localidade_idLocalidade != null) {
                    $pontoTuristico->localidade_idLocalidade = Localidade::find()->where(['id_localidade' => $pontoTuristico->localidade_idLocalidade])->one()->nomeLocalidade;
                }
            }

            return $pontosTuristicos;
        }
        return 'Nenhum Ponto Turístico corresponde à sua pesquisa!';
    }

    public function actionLocalidade($local)
    {
        $localidade = Localidade::findOne(['nomeLocalidade' => $local]);
        if ($localidade != null) {
            $pontosTuristicos = Pontosturisticos::find()
                ->where(['localidade_idLocalidade' => $localidade->id_localidade])
                ->andWhere(['status' => 1])
                ->all();
            if ($pontosTuristicos != null) {
                return $pontosTuristicos;
            }
            return $pontosTuristicos;
        }
        return 'Nenhum Ponto Turístico corresponde à sua pesquisa!';
    }

    public function actionTipomonumento($tipo)
    {
        $tipoMonumento = Tipomonumento::findOne(['descricao' => $tipo]);
        if ($tipoMonumento != null) {
            $pontosTuristicos = Pontosturisticos::find()
                ->where(['tm_idTipoMonumento' => $tipoMonumento->idTipoMonumento])
                ->andWhere(['status' => 1])
                ->all();
            if ($pontosTuristicos != null) {
                return $pontosTuristicos;
            }
        }
        return 'Nenhum Ponto Turístico corresponde à sua pesquisa!';


    }

    public function actionEstatisticas($id)
    {
        $favoritosContador = count(Favoritos::findAll(['pt_idPontoTuristico' => $id]));
        $visitadosContador = count(Visitados::findAll(['pt_idPontoTuristico' => $id]));

        $totalFavoritos = count(Favoritos::find()->all());
        $totalVisitados = count(Visitados::find()->all());

        if ($totalFavoritos != null) {
            $percentagemFavorito = ($favoritosContador / $totalFavoritos) * 100;
        } else {
            $percentagemFavorito = 0;
        }

        if ($totalVisitados != null) {
            $percentagemVisitado = ($visitadosContador / $totalVisitados) * 100;
        } else {
            $percentagemVisitado = 0;
        }

        $pontoTuristicoStat = Pontosturisticos::findOne(['id_pontoTuristico' => $id]);

        return ['Estatisticas' => [
            'ID Ponto Turistico' => $pontoTuristicoStat->id_pontoTuristico,
            'Nome' => $pontoTuristicoStat->nome,
            'Nº de Favoritos' => $favoritosContador,
            '% de Favoritos' => $percentagemFavorito,
            'Nº de Visitados' => $visitadosContador,
            '% de Visitados' => $percentagemVisitado
        ]];
    }

    public function actionSearch($pesquisa)
    {

        $procuraLocalidade = Localidade::find()
            ->andFilterWhere(['like', 'nomeLocalidade', $pesquisa])
            ->one();

        $procuraPontoTuristico = Pontosturisticos::find()
            ->andFilterWhere(['like', 'nome', $pesquisa])
            ->andWhere(['status' => 1])
            ->all();

        if ($procuraPontoTuristico != null) {
            $pontosTuristicos = $procuraPontoTuristico;
        }

        if ($procuraLocalidade != null) {
            $pontosTuristicos = Pontosturisticos::find()
                ->where(['localidade_idLocalidade' => $procuraLocalidade->id_localidade])
                ->andWhere(['status' => 1])
                ->all();
        }

        if ($pontosTuristicos != null) {

            foreach ($pontosTuristicos as $pontoTuristico) {

                if ($pontoTuristico->tm_idTipoMonumento != null) {
                    $pontoTuristico->tm_idTipoMonumento = Tipomonumento::find()->where(['idTipoMonumento' => $pontoTuristico->tm_idTipoMonumento])->one()->descricao;
                }
                if ($pontoTuristico->ec_idEstiloConstrucao != null) {
                    $pontoTuristico->ec_idEstiloConstrucao = Estiloconstrucao::find()->where(['idEstiloConstrucao' => $pontoTuristico->ec_idEstiloConstrucao])->one()->descricao;
                }
                if ($pontoTuristico->localidade_idLocalidade != null) {
                    $pontoTuristico->localidade_idLocalidade = Localidade::find()->where(['id_localidade' => $pontoTuristico->localidade_idLocalidade])->one()->nomeLocalidade;
                }
                $pontoTuristico->foto = 'http://10.0.2.2:9515/imagens/img-pt/' . $pontoTuristico->foto;

            }
            return $pontosTuristicos;
        }
    }

}
