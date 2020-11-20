<?php

namespace backend\controllers;



class CultravelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionPontosTuristicos()
    {
        return $this->render('gerir-pontos-turisticos');
    }

    public function actionGerirUtilizadores()
    {
        return $this->render('gerir-utilizadores');
    }

    public function actionMensagens()
    {
        return $this->render('mensagens');
    }

}
