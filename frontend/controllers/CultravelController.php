<?php
namespace frontend\controllers;

use app\models\Localidade;
use app\models\User;
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

            return $this->redirect(['pontos-interesse', 'localidade' => $model->nomeLocalidade]);
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
        $model = new User();
        $modelprofile = new Userprofile();

        if ($model->load(Yii::$app->request->post())) {

            return $this->render('favoritos');

        } else if ($modelprofile->load(Yii::$app->request->post())){

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
