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
            $procuraLocalidade = Localidade::findOne(['nomeLocalidade' => $model->procurar]);
            $procuraPontoTuristico = Pontosturisticos::find()->where(['nome' => $model->procurar])
                ->andWhere(['status' => 1])->all();
            $procuraEstiloConstrucao = Estiloconstrucao::findOne(['descricao' => $model->procurar]);
            $procuraTipoMonumento = Tipomonumento::findOne(['descricao' => $model->procurar]);

            if ($procuraLocalidade != null) {
                $pontosTuristicos = Pontosturisticos::find()->where(['localidade_idLocalidade' => $procuraLocalidade->id_localidade])->andWhere(['status' => 1])->all();
                if ($pontosTuristicos == null) {
                    Yii::$app->session->setFlash('error', 'Nenhum Ponto Turistico corresponde à sua pesquisa!');
                    return $this->render('index', ['model' => $model]);
                }
            } elseif ($procuraPontoTuristico != null) {
                $pontosTuristicos = $procuraPontoTuristico;
                if ($pontosTuristicos == null) {
                    Yii::$app->session->setFlash('error', 'Nenhum Ponto Turistico corresponde à sua pesquisa!');
                    return $this->render('index', ['model' => $model]);
                }
            } elseif ($procuraEstiloConstrucao != null) {
                $pontosTuristicos = Pontosturisticos::find()->where(['ec_IdEstiloConstrucao' => $procuraEstiloConstrucao->idEstiloConstrucao])->andWhere(['status' => 1])->all();
                if ($pontosTuristicos == null) {
                    Yii::$app->session->setFlash('error', 'Nenhum Ponto Turistico corresponde à sua pesquisa!');
                    return $this->render('index', ['model' => $model]);
                }
            } elseif ($procuraTipoMonumento != null) {
                $pontosTuristicos = Pontosturisticos::find()->where(['tm_IdTipoMonumento' => $procuraTipoMonumento->idTipoMonumento])->andWhere(['status' => 1])->all();
                if ($pontosTuristicos == null) {
                    Yii::$app->session->setFlash('error', 'Nenhum Ponto Turistico corresponde à sua pesquisa!');
                    return $this->render('index', ['model' => $model]);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Nenhum Ponto Turistico corresponde à sua pesquisa!');
                return $this->render('index', ['model' => $model]);
            }
            if ($pontosTuristicos != null) {
                return $this->render('pontos-interesse', [
                    'pontosTuristicos' => $pontosTuristicos,
                    'resultado' => $model->procurar,
                ]);
            }

        }

        return $this->render('index', ['model' => $model]);
    }

    public
    function actionFavoritos()
    {
        if (Yii::$app->getUser()->isGuest != true) {

            $idUser = Yii::$app->user->getId();

            $favoritos = Favoritos::findAll(['user_idUtilizador' => $idUser]);

            if ($favoritos != null) {
                foreach ($favoritos as $favorito) {
                    if ($favorito->ptIdPontoTuristico->status == 1) {
                        $ptFavoritos[] = $favorito->ptIdPontoTuristico;
                        $ptLocalidades[] = $favorito->ptIdPontoTuristico->localidadeIdLocalidade;
                    }
                }

                if ($ptFavoritos != null && $ptLocalidades != null) {
                    return $this->render('favoritos', [
                        'ptFavoritos' => $ptFavoritos,
                        'ptLocalidades' => $ptLocalidades,
                    ]);
                } else {
                    Yii::$app->session->setFlash('error', 'Não tem nenhum ponto turistico adicionado aos Favoritos.');
                    return $this->actionIndex();
                }


            } else {
                Yii::$app->session->setFlash('error', 'Não tem nenhum ponto turistico adicionado aos Favoritos.');
                return $this->actionIndex();
            }

        } else {
            return $this->actionIndex();
        }

    }

    public
    function actionEditarRegisto()
    {
        $idUser = Yii::$app->user->getId();

        $user = User::findOne(['id' => $idUser]);

        $profile = Userprofile::findOne(['id_userProfile' => $idUser]);

        if ($user != null && $profile != null) {

            if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {
                $user->username = Yii::$app->request->post('User')['username'];
                $user->email = Yii::$app->request->post('User')['email'];
                $user->save();
                $profile->save();
            }

            return $this->render('editar-registo', [
                'user' => $user,
                'profile' => $profile,

            ]);
        }

    }

    public
    function actionApagarConta()
    {
        $idUser = Yii::$app->user->getId();

        $user = User::findOne(['id' => $idUser]);

        $user->status = 1;

        $user->save();

        if ($user->save()) {
            Yii::$app->getSession()->setFlash('success', 'A sua conta foi apagada com sucesso!');
            return $this->actionLogout();
        }

        return $this->actionIndex();
    }

    public
    function actionResetPassword()
    {
        $model = new ResetPasswordForm;
        $modeluser = User::find()->where(['id' => Yii::$app->user->identity->getId()])->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $modeluser->setPassword($model->novaPassword);
            $modeluser->save();

            if ($modeluser->save() == true) {
                Yii::$app->getSession()->setFlash('success', 'Palavra-Passe alterada com sucesso!');
                return $this->redirect(['cultravel/index']);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Ocorreu um erro ao alterar a Palavra-Passe');
                return $this->render('reset-password', [
                    'model' => $model
                ]);
            }
        } else {
            return $this->render('reset-password', [
                'model' => $model
            ]);
        }
    }


    public
    function actionVisitados()
    {
        if (Yii::$app->getUser()->isGuest != true) {
            $idUser = Yii::$app->user->getId();

            $visitados = Visitados::findAll(['user_idUtilizador' => $idUser]);

            if ($visitados != null) {


                foreach ($visitados as $visitado) {
                    if ($visitado->ptIdPontoTuristico->status == 1) {
                        $ptLocalidades[] = $visitado->ptIdPontoTuristico->localidadeIdLocalidade;
                    }
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

    public
    function actionContactos()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->saveContacto();
            if ($model->saveContacto() == true) {
                Yii::$app->session->setFlash('success', 'Foi registada a sua mensagem, iremos responder o mais rapido possivel.');
                return $this->actionIndex();
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro ao enviar a sua mensagem!');
                return $this->actionIndex();
            }
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
            if ($model->password == $model->confirmPassword) {
                $model->signup();
                Yii::$app->session->setFlash('success', 'Bem vindo à Cultravel ' . $model->primeiroNome . ' ' . $model->ultimoNome . '!');
                return $this->actionLogin();
            } else {
                Yii::$app->session->setFlash('error', 'Palavras-passe não coicidem!');
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
            $modelUser = User::findOne(['email' => $model->email]);

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
                return $this->actionIndex();
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
        return $this->actionIndex();
    }

    public
    function actionPontosInteresse()
    {
        return $this->render('pontos-interesse');
    }

    public
    function actionPontoInteresseDetails($id)
    {
        $pontoTuristico = Pontosturisticos::find()->where(['id_pontoTuristico' => $id])->andWhere(['status' => 1])->one();
        if ($pontoTuristico != null) {
            $tipoMonumento = Tipomonumento::findOne(['idTipoMonumento' => $pontoTuristico->tm_idTipoMonumento]);
            $localidadeMonumento = Localidade::findOne(['id_localidade' => $pontoTuristico->localidade_idLocalidade]);
            $estiloConstrucao = Estiloconstrucao::findOne(['idEstiloConstrucao' => $pontoTuristico->ec_idEstiloConstrucao]);
            $ratings = Ratings::findAll(['pt_idPontoTuristico' => $id]);
            if ($ratings != null) {
                $mediaRatings = $this->mediaRatings($ratings);
            } elseif ($ratings == null) {
                $mediaRatings = 0;
            }

            $favorito = Favoritos::find()
                ->where(['pt_idPontoTuristico' => $id])->andwhere(['user_idUtilizador' => Yii::$app->user->getId()])->one();

            if ($favorito != null) {
                $favoritoStatus = true;
            } elseif ($favorito == null) {
                $favoritoStatus = false;
            }

            $visitados = Visitados::find()
                ->where(['pt_idPontoTuristico' => $id])->andwhere(['user_idUtilizador' => Yii::$app->user->getId()])->one();

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
            return $this->actionIndex();
        }

    }

    public
    function mediaRatings($ratings)
    {
        $somaRatings = 0;

        foreach ($ratings as $rating) {
            $somaRatings = $somaRatings = $rating->classificacao;
        }
        $mediaRatings = $somaRatings / count($ratings);
        return $mediaRatings;
    }

    public
    function actionPontoInteresseVisitados($idLocalidade)
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

    public
    function actionAdicionarFavoritos($idPontoTuristico)
    {
        $idUser = Yii::$app->user->getId();

        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $idPontoTuristico]);

        if ($pontoTuristico != null) {
            $favorito = new Favoritos();

            $favorito->user_idUtilizador = $idUser;
            $favorito->pt_idPontoTuristico = $pontoTuristico->id_pontoTuristico;
            $favorito->save();

            if ($favorito->save() == true) {
                Yii::$app->session->setFlash('success', 'O ponto turistico foi adicionado aos favoritos!');
                return $this->redirect(['cultravel/ponto-interesse-details', 'id' => $idPontoTuristico]);
            }
        } else {
            return $this->actionIndex();
        }


    }

    public
    function actionRemoverFavoritos($idPontoTuristico)
    {

        $idUser = Yii::$app->user->getId();

        $favorito = Favoritos::find()
            ->where(['pt_idPontoTuristico' => $idPontoTuristico])->andwhere(['user_idUtilizador' => $idUser])->one();

        $favorito->delete();

        if ($favorito->delete() == 0) {
            Yii::$app->session->setFlash('success', 'O ponto turistico foi removido dos favoritos!');
            return $this->redirect(['cultravel/ponto-interesse-details', 'id' => $idPontoTuristico]);
        }
    }

    public
    function actionAdicionarVisitados($idPontoTuristico)
    {
        $idUser = Yii::$app->user->getId();

        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $idPontoTuristico]);

        if ($pontoTuristico != null) {
            $visitado = new Visitados();

            $visitado->user_idUtilizador = $idUser;
            $visitado->pt_idPontoTuristico = $pontoTuristico->id_pontoTuristico;
            $visitado->save();

            if ($visitado->save() == true) {
                Yii::$app->session->setFlash('success', 'O ponto turistico foi adicionado aos visitados!');
                return $this->redirect(['cultravel/ponto-interesse-details', 'id' => $idPontoTuristico]);
            }
        } else {
            return $this->actionIndex();
        }


    }

    public
    function actionRemoverVisitados($idPontoTuristico)
    {

        $idUser = Yii::$app->user->getId();

        $visitados = Visitados::find()
            ->where(['pt_idPontoTuristico' => $idPontoTuristico])->andwhere(['user_idUtilizador' => $idUser])->one();

        $visitados->delete();

        if ($visitados->delete() == 0) {
            Yii::$app->session->setFlash('success', 'O ponto turistico foi removido dos visitados!');
            return $this->redirect(['cultravel/ponto-interesse-details', 'id' => $idPontoTuristico]);
        }
    }

    public
    function actionPontosInteresseFiltro($filtro)
    {
        $idFiltro = Tipomonumento::findOne(['descricao' => $filtro]);

        if ($idFiltro != null) {
            $pontosTuristicos = Pontosturisticos::findAll(['tm_idTipoMonumento' => $idFiltro]);
            if ($pontosTuristicos != null) {
                return $this->render('pontos-interesse', [
                    'pontosTuristicos' => $pontosTuristicos,
                    'tipoMonumento' => $filtro,
                ]);
            }
        } else {
            return $this->actionIndex();
        }

    }

}