<?php

namespace frontend\controllers;

use app\models\Localidade;
use app\models\Pontosturisticos;
use app\models\PontosturisticosSearch;
use common\models\User;
use app\models\Userprofile;
use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class CultravelController extends Controller
{
    public function actionIndex()
    {
        $model = new Localidade();
        if ($model->load(Yii::$app->request->post())) {
            $searchModelPT = new PontosturisticosSearch();

            $pontosTuristicos = $searchModelPT->search(Yii::$app->request->queryParams);


            return $this->render('pontos-interesse', [
                'pontosTuristicos' => $pontosTuristicos,
            ]);
        }
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionFavoritos()
    {
        return $this->render('favoritos');
    }

    public function actionVisitados()
    {
        return $this->render('visitados');
    }

    public function actionContactos()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Obrigado por nos contactar. Iremos responder o mais rapido possivel.');
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro a enviar a sua mensagem.');
            }
            return $this->refresh();
        } else {
            return $this->render('contactos', ['model' => $model,]);
        }
    }

    public function actionSobreNos()
    {
        return $this->render('sobre-nos');
    }

    public function actionRegistar()
    {
        $model = new User();
        $modelprofile = new Userprofile();

        if ($model->load(Yii::$app->request->post())) {

            return $this->render('favoritos');

        } else if ($modelprofile->load(Yii::$app->request->post())) {

            return $this->render('favoritos');
        }
        return $this->render('registar', [
            'model' => $model,
            'modelprofile' => $modelprofile
        ]);
    }


    public function actionLogin()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {

            return $this->render('favoritos');
        }
        return $this->render('login', [
            'model' => $model
        ]);
    }

    public function actionPontosInteresse()
    {
        return $this->render('pontos-interesse');
    }

    public function actionPontoInteresseDetails()
    {
        return $this->render('ponto-interesse-details');
    }

}
