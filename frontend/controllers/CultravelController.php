<?php
namespace frontend\controllers;

use app\models\Localidade;
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

            return $this->render('favoritos');
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
        return $this->render('contactos');
    }

    public function actionSobreNos()
    {
        return $this->render('sobre-nos');
    }

    public function actionRegistar()
    {
        return $this->render('registar');
    }

    public function actionLogin()
    {
        return $this->render('login');
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
