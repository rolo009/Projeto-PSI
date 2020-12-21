<?php

namespace app\modules\v1\controllers;

use common\models\Favoritos;
use common\models\Localidade;
use common\models\Pontosturisticos;
use common\models\Visitados;
use yii\helpers\VarDumper;
use yii\rest\ActiveController;

class PontosturisticosController extends Activecontroller
{
    public $modelClass = 'app\models\Pontosturisticos';

    public function actionMvisitado()
    {
        $pontosTuristicos = Visitados::find()
            ->select(['count(*) AS cnt'])
            ->groupBy(['pt_idPontoTuristico'])
            ->all();
/*
        foreach ($pontosTuristicos as $pontoTuristico){
            $pontoTuristicoMaisVisitado = 0;
            if($pontoTuristico>)
        }*/

        return $pontosTuristicos;
    }

    public function actionLocalidade($local)
    {
        $localidade = Localidade::findOne(['nomeLocalidade' => $local]);

        $pontosTuristicos = Visitados::find()
            ->where(['localidade_idLocalidade' => $localidade->id_localidade])
            ->all();

        return $pontosTuristicos;
    }

    public function actionEstatisticas($id)
    {
        $favoritosContador= count(Favoritos::findAll(['pt_idPontoTuristico'=>$id]));
        $visitadosContador= count(Visitados::findAll(['pt_idPontoTuristico'=>$id]));

        $totalFavoritos = count(Favoritos::find()->all());
        $totalVisitados = count(Visitados::find()->all());

        if($totalFavoritos != null){
            $percentagemFavorito = ($favoritosContador/ $totalFavoritos) * 100;
        }else{
            $percentagemFavorito = 0;
        }

        if($totalVisitados != null){
            $percentagemVisitado = ($visitadosContador/ $totalVisitados) * 100;
        }else{
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


}
