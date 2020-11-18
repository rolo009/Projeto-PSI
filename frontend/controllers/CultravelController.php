<?php

namespace frontend\controllers;

use app\models\Estiloconstrucao;
use app\models\Favoritos;
use app\models\Localidade;
use app\models\Pontosturisticos;
use app\models\Ratings;
use app\models\Tipomonumento;
use app\models\Visitados;
use common\models\LoginForm;
use common\models\User;
use app\models\Userprofile;
use frontend\models\ContactForm;
use frontend\models\SignupForm;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use \yii\db\Query;


/**
 * Site controller
 */
class CultravelController extends Controller
{
    public function actionIndex()
    {
        $model = new Localidade();

        if ($model->load(Yii::$app->request->post())) {

            $localidade = Localidade::find()->where(['nomeLocalidade' => $model->nomeLocalidade])->one();

            $pontosTuristicos = Pontosturisticos::findAll(['localidade_idLocalidade' => $localidade->id_localidade]);

            return $this->render('pontos-interesse', [
                'pontosTuristicos' => $pontosTuristicos,
            ]);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionFavoritos($idUser)
    {
        $favoritos = Favoritos::findAll(['user_idUtilizador	' => $idUser]);

        return $this->render('favoritos', [
            'favoritos' => $favoritos,
        ]);
    }

    public function actionVisitados($idUser)
    {
        $visitados = Visitados::findAll(['user_idUtilizador	' => $idUser]);

        return $this->render('visitados', [
            'visitados' => $visitados,
        ]);
    }

    public function actionContactos()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Obrigado por nos contactar. Iremos responder o mais rapido possivel.');
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro, a enviar a sua mensagem.');
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
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->actionLogin();
        }
        else {
            VarDumper::dump($model->signup());
            echo 'ERROR';
        }


        return $this->render('registar', [
            'model' => $model,
        ]);
    }


    public function actionLogin()
    {

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->actionIndex();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->actionIndex();
    }

    public function actionPontosInteresse()
    {
        return $this->render('pontos-interesse');
    }

    public function actionPontoInteresseDetails($id)
    {
        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $id]);
        $tipoMonumento = Tipomonumento::findOne(['idTipoMonumento' => $pontoTuristico->tm_idTipoMonumento]);
        $localidadeMonumento = Localidade::findOne(['id_localidade' => $pontoTuristico->localidade_idLocalidade]);
        $estiloConstrucao = Estiloconstrucao::findOne(['idEstiloConstrucao' => $pontoTuristico->ec_idEstiloConstrucao]);
        $ratings = Ratings::findAll(['pt_idPontoTuristico' =>$id]);
        $mediaRatings = $this->mediaRatings($ratings);
        return $this->render('ponto-interesse-details', [
            'pontoTuristico' => $pontoTuristico,
            'tipoMonumento' => $tipoMonumento,
            'localidadeMonumento' => $localidadeMonumento,
            'estiloMonumento' => $estiloConstrucao,
            'ratingMonumento' => $mediaRatings,
        ]);
    }

    public function mediaRatings($ratings){
        $somaRatings = 0;
        /*
        foreach ($ratings as $rating) {
            $somaRatings = $somaRatings = $rating->classificacao;
        }
        $mediaRatings = $somaRatings/count($ratings);*/
        $mediaRatings1 = 4;
        return $mediaRatings1;
    }

}
