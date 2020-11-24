<?php

namespace frontend\controllers;

use app\models\Estiloconstrucao;
use app\models\Favoritos;
use app\models\Localidade;
use app\models\Pontosturisticos;
use app\models\Ratings;
use app\models\Tipomonumento;
use app\models\Userprofile;
use app\models\Visitados;
use common\models\LoginForm;
use common\models\User;
use frontend\models\ContactForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


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

    public function actionFavoritos()
    {

        if (Yii::$app->getUser()->isGuest != true) {

            $idUser = Yii::$app->user->getId();

            $favoritos = Favoritos::findAll(['user_idUtilizador' => $idUser]);

            if ($favoritos != null) {

                foreach ($favoritos as $favorito) {
                    $ptFavoritos[] = $favorito->ptIdPontoTuristico;
                    $ptLocalidades[] = $favorito->ptIdPontoTuristico->localidadeIdLocalidade;
                }

                return $this->render('favoritos', [
                    'ptFavoritos' => $ptFavoritos,
                    'ptLocalidades' => $ptLocalidades,
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Não tem nenhum ponto turistico adicionado aos Favoritos.');
                return $this->actionIndex();
            }

        } else {
            return $this->actionIndex();
        }

    }

    public function actionEditarRegisto()
    {
        //if (Yii::$app->getUser()->isGuest != true) {
            $idUser = Yii::$app->user->getId();

        $user = User::findOne(['id' => $idUser]);
        if (!$user) {
            throw new NotFoundHttpException("The user was not found.");
        }

        $profile = Userprofile::findOne(['id_userProfile' => $idUser]);

        if (!$profile) {
            throw new NotFoundHttpException("The user has no profile.");
        }

        $user->scenario = 'update';
        $profile->scenario = 'update';

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
            $isValid = $user->validate();
            $isValid = $profile->validate() && $isValid;
            if ($isValid) {
                $user->save(false);
                $profile->save(false);
                return $this->redirect(['editar-registo', $profile, $user]);
            }
        }

        return $this->render('editar-registo', [
            'user' => $user,
            'profile' => $profile,

        ]);
    }

    public function actionVisitados()
    {
        if (Yii::$app->getUser()->isGuest != true) {
            $idUser = Yii::$app->user->getId();

            $visitados = Visitados::findAll(['user_idUtilizador' => $idUser]);

            if ($visitados != null) {


                foreach ($visitados as $visitado) {
                    $ptLocalidades[] = $visitado->ptIdPontoTuristico->localidadeIdLocalidade;
                }

                return $this->render('visitados', [
                    'ptLocalidades' => $ptLocalidades
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Não tem nenhum ponto turistico adicionado aos Visitados.');
                return $this->actionIndex();
            }
        } else {
            return $this->actionIndex();
        }
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
        if ($model->load(Yii::$app->request->post())) {
            if ($model->password == $model->confirmPassword) {
                $model->signup();
                Yii::$app->session->setFlash('success', 'Bem vindo à Cultravel, ' . $model->primeiroNome . ' ' . $model->ultimoNome . '!');
                return $this->actionLogin();
            } else {
                Yii::$app->session->setFlash('error', 'Palavras-passe não coicidem!');
            }
        }
        return $this->render('registar', [
            'model' => $model,
        ]);
    }


    public function actionLogin()
    {

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $session = Yii::$app->session;
            if ($session->isActive) {
                $userId = User::findOne(['email' => $model->email]);
                $session->set('userId', $userId->id);
            } else {
                $session->open();
                $userId = User::findOne(['email' => $model->email]);
                $session->set('userId', $userId->id);
            }

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
        $ratings = Ratings::findAll(['pt_idPontoTuristico' => $id]);
        $mediaRatings = $this->mediaRatings($ratings);
        $rating = new Ratings();
        return $this->render('ponto-interesse-details', [
            'pontoTuristico' => $pontoTuristico,
            'tipoMonumento' => $tipoMonumento,
            'localidadeMonumento' => $localidadeMonumento,
            'estiloMonumento' => $estiloConstrucao,
            'ratingMonumento' => $mediaRatings,
            'rating' => $rating,
        ]);
    }

    public function mediaRatings($ratings)
    {
        $somaRatings = 0;
        /*
        foreach ($ratings as $rating) {
            $somaRatings = $somaRatings = $rating->classificacao;
        }
        $mediaRatings = $somaRatings/count($ratings);*/
        $mediaRatings1 = 4;
        return $mediaRatings1;
    }

    public function actionPontoInteresseVisitados($idLocalidade)
    {
        if (Yii::$app->getUser()->isGuest != true) {
            $idUser = Yii::$app->user->getId();

            $localidade = Localidade::findOne(['id_localidade' => $idLocalidade]);


            $ptVisitados = Pontosturisticos::find()
                ->select('pontosturisticos.*')
                ->from('pontosturisticos')
                ->leftJoin('visitados', 'pontosturisticos.id_pontoTuristico = visitados.pt_idPontoTuristico')
                ->where(['visitados.user_idUtilizador' => $idUser])
                ->andWhere(['pontosturisticos.localidade_idLocalidade' => $idLocalidade])
                ->all();


            return $this->render('pontos-interesse-visitados', [
                'ptVisitados' => $ptVisitados,
                'localidade' => $localidade,
            ]);
        } else {
            return $this->actionIndex();
        }
    }

    public function actionAdicionarFavoritos($idPontoTuristico)
    {

        $idUser = Yii::$app->user->getId();

        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $idPontoTuristico]);

        if ($pontoTuristico != null) {
            $favoritos = new Favoritos();

            $favoritos->user_idUtilizador = $idUser;
            $favoritos->ptIdPontoTuristico = $pontoTuristico->id_pontoTuristico;

            $favoritos->save();

            if ($favoritos->save() == true) {
                Yii::$app->session->setFlash('success', 'O ponto turistico foi adicionado aos favoritos!');
            }
        } else {
            return $this->actionIndex();
        }


    }

    public function RemoverFavoritos($idPontoTuristico)
    {

        $idUser = Yii::$app->user->getId();

        $favoritos = new Favoritos();

        $favoritos->user_idUtilizador = $idUser;
        $favoritos->ptIdPontoTuristico = $idPontoTuristico;

        $favoritos->delete();

        if ($favoritos->delete() == true) {
            Yii::$app->session->setFlash('success', 'O ponto turistico foi removido dos favoritos!');
        }
    }

    public function actionPontosInteresseFiltro($filtro)
    {
        $idFiltro = Tipomonumento::findOne(['descricao' => $filtro]);

        if ($idFiltro != null) {
            $pontosTuristicos = Pontosturisticos::findAll(['tm_idTipoMonumento' => $idFiltro]);
            if ($pontosTuristicos != null) {
                return $this->render('pontos-interesse', [
                    'pontosTuristicos' => $pontosTuristicos,
                ]);
            }
        } else {
            return $this->actionIndex();
        }

    }

}