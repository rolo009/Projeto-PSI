<?php

namespace frontend\controllers;

use common\models\Contactos;
use common\models\Estiloconstrucao;
use common\models\Ratings;
use common\models\Tipomonumento;
use common\models\Userprofile;
use common\models\Favoritos;
use common\models\Localidade;
use common\models\Pontosturisticos;
use common\models\LoginForm;
use common\models\User;
use common\models\Visitados;
use frontend\models\ContactForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SearchModel;
use frontend\models\SignupForm;
use http\Exception;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class CultravelController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'pontos-interesse', 'ponto-interesse-details', 'favoritos', 'adicionar-favoritos', 'remover-favoritos', 'editar-registo', 'visitados', 'adicionar-visitados', 'remover-visitados', 'ponto-interesse-visitados', 'contactos', 'sobre-nos', 'login', 'logout', 'registar'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'pontos-interesse', 'ponto-interesse-details', 'contactos', 'sobre-nos', 'login', 'registar'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'pontos-interesse', 'ponto-interesse-details', 'favoritos', 'adicionar-favoritos', 'remover-favoritos', 'editar-registo', 'visitados', 'adicionar-visitados', 'remover-visitados', 'ponto-interesse-visitados', 'contactos', 'sobre-nos', 'login', 'logout', 'registar'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $model = new SearchModel();

        if ($model->load(Yii::$app->request->post())) {
            $pontosTuristicos = null;

            $procuraLocalidade = Localidade::find()
                ->where(['nomeLocalidade' => $model->procurar])
                ->one();

            $procuraPontoTuristico = Pontosturisticos::find()->where(['nome' => $model->procurar])
                ->andWhere(['status' => 1])
                ->all();

            $procuraEstiloConstrucao = Estiloconstrucao::find()
                ->where(['descricao' => $model->procurar])
                ->one();

            $procuraTipoMonumento = Tipomonumento::find()
                ->where(['descricao' => $model->procurar])
                ->one();

            if ($procuraLocalidade != null) {

                $pontosTuristicos = Pontosturisticos::find()
                    ->where(['localidade_idLocalidade' => $procuraLocalidade->id_localidade])
                    ->andWhere(['status' => 1])
                    ->all();

            } elseif ($procuraPontoTuristico != null) {
                $pontosTuristicos = $procuraPontoTuristico;

            } elseif ($procuraEstiloConstrucao != null) {
                $pontosTuristicos = Pontosturisticos::find()
                    ->where(['ec_IdEstiloConstrucao' => $procuraEstiloConstrucao->idEstiloConstrucao])
                    ->andWhere(['status' => 1])
                    ->all();

            } elseif ($procuraTipoMonumento != null) {
                $pontosTuristicos = Pontosturisticos::find()
                    ->where(['tm_IdTipoMonumento' => $procuraTipoMonumento->idTipoMonumento])
                    ->andWhere(['status' => 1])
                    ->all();
            }
            if ($pontosTuristicos != null) {
                return $this->render('pontos-interesse', [
                    'pontosTuristicos' => $pontosTuristicos,
                    'resultado' => $model->procurar,
                ]);

            } else {
                Yii::$app->session->setFlash('error', 'Nenhum Ponto Turistico corresponde à sua pesquisa!');
                return $this->render('index', ['model' => $model]);
            }

        }

        return $this->render('index', ['model' => $model]);
    }

    public
    function actionFavoritos()
    {
        if (Yii::$app->getUser()->isGuest != true) {

            $idUser = Yii::$app->user->getId();

            $favoritos = Favoritos::find()
                ->where(['user_idUtilizador' => $idUser])
                ->all();

            if ($favoritos != null) {
                foreach ($favoritos as $favorito) {
                    $ptFavoritos[] = $favorito->ptIdPontoTuristico;
                }

                foreach ($ptFavoritos as $ptFavorito) {
                    $ptFavorito->localidade_idLocalidade = $ptFavorito->localidadeIdLocalidade->nomeLocalidade;
                }

                if ($ptFavoritos != null) {
                    return $this->render('favoritos', [
                        'ptFavoritos' => $ptFavoritos,
                    ]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Não tem nenhum ponto turistico adicionado aos Favoritos.');
            }
        }
        return $this->redirect(['index']);

    }

    public
    function actionEditarRegisto()
    {
        $idUser = Yii::$app->user->getId();

        $user = User::find()
            ->where(['id' => $idUser])
            ->one();

        $profile = Userprofile::find()
            ->where(['id_user_rbac' => $idUser])
            ->one();

        if ($user != null && $profile != null) {

            if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {

                if ($user->username != Yii::$app->request->post('User')['username']) {
                    $usernameSearch = User::find()->where(['username' => Yii::$app->request->post('User')['username']])->one();
                    if ($usernameSearch == null) {
                        $user->username = Yii::$app->request->post('User')['username'];
                    } else {
                        Yii::$app->session->setFlash('error', 'O nome de utilizador que introduziu já se encontra registado!');
                    }
                }

                if ($user->email != Yii::$app->request->post('User')['email']) {
                    $emailSearch = User::find()->where(['email' => Yii::$app->request->post('User')['email']])->one();
                    if ($emailSearch == null) {
                        $user->email = Yii::$app->request->post('User')['email'];
                    } else {
                        Yii::$app->session->setFlash('error', 'O email que introduziu já se encontra registado!');
                    }
                }

                if ($user->save() && $profile->save()) {
                    Yii::$app->session->setFlash('success', 'Os seus dados pessoais foram atualizados com sucesso!');
                    return $this->redirect(['index']);
                }
            }
            return $this->render('editar-registo', [
                'user' => $user,
                'profile' => $profile,
            ]);
        }
        Yii::$app->session->setFlash('error', 'Não é possivel editar o registo deste utilizador!');
        return $this->redirect(['index']);

    }

    public function actionApagarConta()
    {
        $idUser = Yii::$app->user->getId();

        $user = User::find()
            ->where(['id' => $idUser])
            ->one();

        if ($user != null) {
            $user->status = User::STATUS_DELETE;

            if ($user->save()) {
                Yii::$app->getSession()->setFlash('success', 'A sua conta foi apagada com sucesso!');
                return $this->actionLogout();
            }
        } else {
            Yii::$app->getSession()->setFlash('success', 'Ocorreu um erro ao apagar a sua conta!');
        }
        return $this->redirect(['index']);
    }

    public
    function actionAlterarPassword()
    {
        $userID = Yii::$app->user->identity->getId();

        $model = new ResetPasswordForm;
        $modeluser = User::find()
            ->where(['id' => $userID])
            ->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($modeluser->validatePassword($model->password) == true) {
                $modeluser->setPassword($model->novaPassword);

                if ($modeluser->save() == true) {
                    Yii::$app->getSession()->setFlash('success', 'Palavra-Passe alterada com sucesso!');
                    return $this->redirect(['index']);
                }
            }
            Yii::$app->getSession()->setFlash('error', 'Ocorreu um erro ao alterar a Palavra-Passe');
            return $this->redirect(['alterar-password']);
        } else {
            return $this->render('alterar-password', [
                'model' => $model
            ]);
        }


    }


    public function actionVisitados()
    {
        if (Yii::$app->getUser()->isGuest != true) {
            $idUser = Yii::$app->user->getId();

            $visitados = Visitados::find()
                ->where(['user_idUtilizador' => $idUser])
                ->all();

            if ($visitados != null) {

                foreach ($visitados as $visitado) {

                    $ptLocalidades = Localidade::find()
                        ->where(['id_localidade' => $visitado->ptIdPontoTuristico->localidadeIdLocalidade])
                        ->groupBy('nomeLocalidade')
                        ->all();
                }

                return $this->render('visitados', [
                    'ptLocalidades' => $ptLocalidades
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Não tem nenhum ponto turistico adicionado aos Visitados.');
                return $this->redirect(['index']);
            }
        } else {
            return $this->redirect(['index']);
        }
    }

    public
    function actionContactos()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->saveContacto()) {
                Yii::$app->session->setFlash('success', 'A sua mensagem foi registada, iremos responder o mais rapido possivel.');
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro ao enviar a sua mensagem!');
            }
            return $this->redirect(['index']);

        } else {
            return $this->render('contactos', ['model' => $model,]);

        }


    }

    public
    function actionSobreNos()
    {
        return $this->render('sobre-nos');
    }

    public
    function actionRegistar()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $usernameSearch = User::find()
                ->where(['username' => $model->username])
                ->one();

            $emailSearch = User::find()
                ->where(['email' => $model->email])
                ->one();
            if ($usernameSearch == null) {
                if ($emailSearch == null) {

                    if ($model->password == $model->confirmPassword) {
                        $model->signup();
                        Yii::$app->session->setFlash('success', 'Bem vindo à Cultravel ' . $model->primeiroNome . ' ' . $model->ultimoNome . '!');
                        return $this->redirect(['login']);
                    } else {
                        Yii::$app->session->setFlash('error', 'Palavras-passe não coicidem!');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'O Email que introduziu já se encontra registado!');
                }
            } else {
                Yii::$app->session->setFlash('error', 'O Nome de Utilizador que introduziu já se encontra registado!');
            }
        }
        return $this->render('registar', [
            'model' => $model,
        ]);
    }

    public
    function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $modelUser = User::find()->where(['email' => $model->email])->one();
            if ($modelUser != null) {

                if ($modelUser->status == 1) {
                    Yii::$app->session->setFlash('error', 'Esta conta foi apagada! Para mais informação contacte o suporte.');
                    return $this->render('login', [
                        'model' => $model,
                    ]);
                } else if ($modelUser->status == 0) {
                    Yii::$app->session->setFlash('error', 'Esta conta foi banida!');
                    return $this->render('login', [
                        'model' => $model,
                    ]);
                } else if ($modelUser->status == 9) {
                    Yii::$app->session->setFlash('error', 'Esta conta está inativa!');
                    return $this->render('login', [
                        'model' => $model,
                    ]);
                } else {
                    $model->login();
                    if ($model->login() == true) {
                        return $this->redirect(['index']);
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'Não há nenhuma conta associada a este email!');
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public
    function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['index']);
    }

    public
    function actionPontosInteresse()
    {
        return $this->render('pontos-interesse');
    }

    public
    function actionPontoInteresseDetails($id)
    {
        $pontoTuristico = Pontosturisticos::find()
            ->where(['id_pontoTuristico' => $id])
            ->andWhere(['status' => 1])
            ->one();

        if ($pontoTuristico != null) {
            $tipoMonumento = Tipomonumento::find()
                ->where(['idTipoMonumento' => $pontoTuristico->tm_idTipoMonumento])
                ->one();
            $localidadeMonumento = Localidade::find()
                ->where(['id_localidade' => $pontoTuristico->localidade_idLocalidade])
                ->one();
            $estiloConstrucao = Estiloconstrucao::find()
                ->where(['idEstiloConstrucao' => $pontoTuristico->ec_idEstiloConstrucao])
                ->one();
            $ratings = Ratings::find()
                ->where(['pt_idPontoTuristico' => $id])
                ->all();

            if ($ratings != null) {
                $mediaRatings = $this->mediaRatings($ratings);
            } elseif ($ratings == null) {
                $mediaRatings = 0;
            }

            $favorito = Favoritos::find()
                ->where(['pt_idPontoTuristico' => $id])
                ->andwhere(['user_idUtilizador' => Yii::$app->user->getId()])
                ->one();

            if ($favorito != null) {
                $favoritoStatus = true;
            } elseif ($favorito == null) {
                $favoritoStatus = false;
            }

            $visitados = Visitados::find()
                ->where(['pt_idPontoTuristico' => $id])
                ->andwhere(['user_idUtilizador' => Yii::$app->user->getId()])
                ->one();

            if ($visitados != null) {
                $visitadosStatus = true;
            } elseif ($visitados == null) {
                $visitadosStatus = false;
            }

            if ($estiloConstrucao != null) {
                $estiloConstrucao = $estiloConstrucao->descricao;
            }

            if ($tipoMonumento != null) {
                $tipoMonumento = $tipoMonumento->descricao;
            }

            $rating = new Ratings();

            if ($rating->load(Yii::$app->request->post())) {
                $ratingVerificacao = Ratings::find()
                    ->where(['pt_idPontoTuristico' => $id])
                    ->andWhere(['user_idUtilizador' => Yii::$app->user->getId()])
                    ->one();

                if ($ratingVerificacao == null) {
                    $rating->user_idUtilizador = Yii::$app->user->getId();
                    $rating->pt_idPontoTuristico = $id;
                    $rating->save();

                } elseif ($ratingVerificacao != null) {
                    $ratingVerificacao->classificacao = $rating->classificacao;

                }

            }

            return $this->render('ponto-interesse-details', [
                'pontoTuristico' => $pontoTuristico,
                'tipoMonumento' => $tipoMonumento,
                'localidadeMonumento' => $localidadeMonumento,
                'estiloMonumento' => $estiloConstrucao,
                'ratingMonumento' => $mediaRatings,
                'rating' => $rating,
                'favoritoStatus' => $favoritoStatus,
                'visitadoStatus' => $visitadosStatus,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Este ponto turistico já não se encontra disponivel!');
            return $this->redirect(['index']);
        }

    }

    public
    function mediaRatings($ratings)
    {
        $somaRatings = 0;

        foreach ($ratings as $rating) {
            $somaRatings = $somaRatings + $rating->classificacao;
        }
        $mediaRatings = $somaRatings / count($ratings);
        return $mediaRatings;
    }

    public
    function actionPontoInteresseVisitados($idLocalidade)
    {
        if (Yii::$app->getUser()->isGuest != true) {
            $idUser = Yii::$app->user->getId();

            $localidade = Localidade::find()
                ->where(['id_localidade' => $idLocalidade])
                ->one();

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
            return $this->redirect(['index']);
        }
    }

    public
    function actionAdicionarFavoritos($idPontoTuristico)
    {
        $idUser = Yii::$app->user->getId();

        $pontoTuristico = Pontosturisticos::find()
            ->where(['id_pontoTuristico' => $idPontoTuristico])
            ->one();

        if ($pontoTuristico != null && $idUser != null) {
            $favorito = new Favoritos();

            $favorito->user_idUtilizador = $idUser;
            $favorito->pt_idPontoTuristico = $pontoTuristico->id_pontoTuristico;

            if ($favorito->save()) {
                Yii::$app->session->setFlash('success', 'O ponto turistico foi adicionado aos favoritos!');
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro ao adicionar o ponto turistico aos favoritos!');
            }
        }
        return $this->redirect(['ponto-interesse-details', 'id' => $idPontoTuristico]);
    }

    public function actionRemoverFavoritos($idPontoTuristico)
    {
        $idUser = Yii::$app->user->getId();

        $favorito = Favoritos::find()
            ->where(['pt_idPontoTuristico' => $idPontoTuristico])
            ->andwhere(['user_idUtilizador' => $idUser])
            ->one();

        if ($favorito != null && $idUser != null) {
            if ($favorito->delete()) {
                Yii::$app->session->setFlash('success', 'O ponto turistico foi removidos dos favoritos!');
            }
        }
        return $this->redirect(['ponto-interesse-details', 'id' => $idPontoTuristico]);
    }

    public
    function actionAdicionarVisitados($idPontoTuristico)
    {
        $idUser = Yii::$app->user->getId();

        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $idPontoTuristico]);

        if ($pontoTuristico != null && $idUser != null) {
            $visitado = new Visitados();

            $visitado->user_idUtilizador = $idUser;
            $visitado->pt_idPontoTuristico = $pontoTuristico->id_pontoTuristico;

            if ($visitado->save()) {
                Yii::$app->session->setFlash('success', 'O ponto turistico foi adicionado aos visitados!');
                return $this->redirect(['ponto-interesse-details', 'id' => $idPontoTuristico]);
            }
        }
        return $this->redirect(['ponto-interesse-details', 'id' => $idPontoTuristico]);
    }

    public
    function actionRemoverVisitados($idPontoTuristico)
    {

        $idUser = Yii::$app->user->getId();

        $visitados = Visitados::find()
            ->where(['pt_idPontoTuristico' => $idPontoTuristico])
            ->andwhere(['user_idUtilizador' => $idUser])
            ->one();

        if ($visitados != null && $idUser != null) {
            if ($visitados->delete()) {
                Yii::$app->session->setFlash('success', 'O ponto turistico foi removidos dos visitados!');
            }

        }
        return $this->redirect(['ponto-interesse-details', 'id' => $idPontoTuristico]);
    }

    public
    function actionPontosInteresseFiltro($filtro)
    {
        $tipoMonumento = Tipomonumento::find()
            ->where(['descricao' => $filtro])
            ->one();
        if ($tipoMonumento != null) {

            $pontosTuristicos = Pontosturisticos::find()
                ->where(['tm_idTipoMonumento' => $tipoMonumento->idTipoMonumento])
                ->all();


            if ($pontosTuristicos != null) {
                return $this->render('pontos-interesse', [
                    'pontosTuristicos' => $pontosTuristicos,
                    'tipoMonumento' => $tipoMonumento->descricao,
                ]);
            }
        }
        Yii::$app->session->setFlash('error', 'Não há nenhum ponto turistico na categoria ' . $filtro . '!');
        return $this->redirect(['index']);
    }

}