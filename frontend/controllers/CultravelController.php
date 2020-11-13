<?php

namespace frontend\controllers;

use app\models\Localidade;
use app\models\LocalidadeSearch;
use app\models\Pontosturisticos;
use app\models\PontosturisticosSearch;
use app\models\TblCommentSearch;
use app\models\TblPost;
use app\models\TblPostSearch;
use app\models\User;
use app\models\Userprofile;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Yaml\Dumper;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;


/**
 * Site controller
 */
class CultravelController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new LocalidadeSearch();

        if ($searchModel->load(Yii::$app->request->post())) {
            $dataProvider = $searchModel->search(Yii::$app->request->post());
            VarDumper::dump($dataProvider);

            return $this->render('pontos-interesse', [
                'dataProvider' => $dataProvider
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel
        ]);
    }

    public function actionPontosInteresse($idLocalidade)
    {

        $searchModel = new PontosturisticosSearch();

        $pontosTuristicos = Pontosturisticos::findOne($idLocalidade);

        return $this->render('pontos-interesse');
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


    public function actionPontoInteresseDetails()
    {
        return $this->render('ponto-interesse-details');
    }

}
