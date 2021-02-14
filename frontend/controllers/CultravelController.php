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
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
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

            return $this->redirect(['pontos-interesse', 'pesquisa' => $model->procurar]);
        }

        return $this->render('index', ['model' => $model]);
    }

    public
    function actionPontosInteresse($pesquisa)
    {

        $pontosTuristicos = null;

        $procuraLocalidade = Localidade::find()
            ->where(['nomeLocalidade' => $pesquisa])
            ->one();

        $procuraPontoTuristico = Pontosturisticos::find()->where(['nome' => $pesquisa])
            ->andWhere(['status' => 1]);

        $procuraEstiloConstrucao = Estiloconstrucao::find()
            ->where(['descricao' => $pesquisa])
            ->one();

        $procuraTipoMonumento = Tipomonumento::find()
            ->where(['descricao' => $pesquisa])
            ->one();

        if ($procuraLocalidade != null) {
            $pontosTuristicos = Pontosturisticos::find()
                ->where(['localidade_idLocalidade' => $procuraLocalidade->id_localidade])
                ->andWhere(['status' => 1]);

        } elseif ($procuraEstiloConstrucao != null) {
            $pontosTuristicos = Pontosturisticos::find()
                ->where(['ec_IdEstiloConstrucao' => $procuraEstiloConstrucao->idEstiloConstrucao])
                ->andWhere(['status' => 1]);


        } elseif ($procuraTipoMonumento != null) {
            $pontosTuristicos = Pontosturisticos::find()
                ->where(['tm_IdTipoMonumento' => $procuraTipoMonumento->idTipoMonumento])
                ->andWhere(['status' => 1]);
        }
        elseif ($procuraPontoTuristico != null) {
            $pontosTuristicos = $procuraPontoTuristico;

        }
        $countQuery = clone $pontosTuristicos;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages -> pageSize = 16;
        $pontosTuristicos = $pontosTuristicos->offset($pages->offset)->limit($pages->limit)->all();
        if ($pontosTuristicos != null) {
            return $this->render('pontos-interesse', [
                'pontosTuristicos' => $pontosTuristicos,
                'resultado' => $pesquisa,
                'pages' => $pages,
            ]);

        } else {
            Yii::$app->session->setFlash('error', 'Nenhum Ponto Turistico corresponde à sua pesquisa!');
            return $this->redirect('index');
        }
    }

    public function actionFavoritos()
    {
        if (Yii::$app->getUser()->isGuest != true) {

            $idUser = Yii::$app->user->getId();

            $favoritos = Favoritos::find()
                ->where(['user_idUtilizador' => $idUser])
                ->all();

            if ($favoritos != null) {
                foreach ($favoritos as $favorito) {
                    $ptFavoritos[] = Pontosturisticos::find()
                        ->where(['id_pontoTuristico' => $favorito->pt_idPontoTuristico])
                        ->andWhere(['status' => 1])
                        ->one();
                }

                if ($ptFavoritos[0] != null) {
                    return $this->render('favoritos', [
                        'ptFavoritos' => $ptFavoritos,
                    ]);
                }
            }
            Yii::$app->session->setFlash('error', 'Não tem nenhum ponto turistico adicionado aos Favoritos.');
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

        $profile = $user->userprofile;

        if ($user != null && $profile != null) {

            if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post())) {

                if ($user->username != Yii::$app->request->post('User')['username']) {
                    $usernameSearch = User::find()->where(['username' => Yii::$app->request->post('User')['username']])->one();
                    if ($usernameSearch == null) {
                        $user->username = Yii::$app->request->post('User')['username'];
                    } else {
                        Yii::$app->session->setFlash('error', 'O nome de utilizador que introduziu já se encontra registado!');
                        return $this->redirect(['editar-registo']);
                    }
                }

                if ($user->email != Yii::$app->request->post('User')['email']) {
                    $emailSearch = User::find()->where(['email' => Yii::$app->request->post('User')['email']])->one();
                    if ($emailSearch == null) {
                        $user->email = Yii::$app->request->post('User')['email'];
                    } else {
                        Yii::$app->session->setFlash('error', 'O email que introduziu já se encontra registado!');
                        return $this->redirect(['editar-registo']);
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
                if($model->novaPassword == $model->confirmNovaPassword){
                    $modeluser->setPassword($model->novaPassword);

                    if ($modeluser->save() == true) {
                        Yii::$app->getSession()->setFlash('success', 'Palavra-Passe alterada com sucesso!');
                        return $this->redirect(['index']);
                    }
                }else{
                    Yii::$app->getSession()->setFlash('error', 'As Palavra-Passe não coincidem!');
                }
            }else{
                Yii::$app->getSession()->setFlash('error', 'Esta palavra-passe não corresponde à palavra-passe desta conta!');
            }
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

            $ptVisitados = Pontosturisticos::find()
                ->select('pontosturisticos.localidade_idLocalidade')
                ->from('pontosturisticos')
                ->leftJoin('visitados', 'pontosturisticos.id_pontoTuristico = visitados.pt_idPontoTuristico')
                ->where(['visitados.user_idUtilizador' => $idUser])
                ->groupBy('pontosturisticos.localidade_idLocalidade')
                ->all();

            if ($ptVisitados != null) {
                return $this->render('visitados', [
                    'ptVisitados' => $ptVisitados
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
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public
    function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['index']);
    }


    public
    function actionPontoInteresseDetails($pesquisa, $id)
    {
        $pontoTuristico = Pontosturisticos::find()
            ->where(['id_pontoTuristico' => $id])
            ->andWhere(['status' => 1])
            ->one();

        if ($pontoTuristico != null) {
            $ratings = $pontoTuristico->ratings;
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

            $ratingUser = Ratings::find()
                ->where(['user_idUtilizador' => Yii::$app->user->getId()])
                ->andWhere(['pt_idPontoTuristico' => $id])
                ->one();

            return $this->render('ponto-interesse-details', [
                'pontoTuristico' => $pontoTuristico,
                'ratingMonumento' => $mediaRatings,
                'rating' => $rating,
                'ratingUser' => $ratingUser,
                'favoritoStatus' => $favoritoStatus,
                'visitadoStatus' => $visitadosStatus,
                'pesquisa' => $pesquisa
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

            if ($ptVisitados != null) {
                return $this->render('pontos-interesse-visitados', [
                    'ptVisitados' => $ptVisitados,
                    'localidade' => $localidade,
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Não tem nenhum ponto turistico adicionado aos Visitados (' . $localidade->nomeLocalidade . ').');
            }
        }
        return $this->redirect(['index']);
    }

    public
    function actionAdicionarFavoritos($idPontoTuristico, $pesquisa, $url)
    {
        $idUser = Yii::$app->user->getId();

        $pontoTuristico = Pontosturisticos::find()
            ->where(['id_pontoTuristico' => $idPontoTuristico])
            ->one();

        if ($pontoTuristico != null && $idUser != null) {
            $favorito = new Favoritos();

            $favorito->user_idUtilizador = $idUser;
            $favorito->pt_idPontoTuristico = $pontoTuristico->id_pontoTuristico;

            $favorito->save();
        }
        if ($url == 'cultravel/ponto-interesse-details') {
            return $this->redirect(['ponto-interesse-details', 'pesquisa' => $pesquisa, 'id' => $idPontoTuristico]);
        } else if ($url == 'cultravel/favoritos') {
            return $this->redirect(['favoritos']);
        } else {
            Yii::$app->session->setFlash('error', 'Não foi possível adicionar este ponto turistico aos favoritos!');
            return $this->redirect(['index']);
        }
    }

    public function actionRemoverFavoritos($idPontoTuristico, $pesquisa, $url)
    {
        $idUser = Yii::$app->user->getId();

        $favorito = Favoritos::find()
            ->where(['pt_idPontoTuristico' => $idPontoTuristico])
            ->andwhere(['user_idUtilizador' => $idUser])
            ->one();

        if ($favorito != null && $idUser != null) {
            $favorito->delete();
        }

        if ($url == 'cultravel/ponto-interesse-details') {
            return $this->redirect(['ponto-interesse-details', 'pesquisa' => $pesquisa, 'id' => $idPontoTuristico]);
        } else if ($url == 'cultravel/favoritos') {
            return $this->redirect(['favoritos']);
        } else {
            Yii::$app->session->setFlash('error', 'Não foi possível remover este ponto turistico dos favoritos!');
            return $this->redirect(['index']);
        }
    }

    public
    function actionAdicionarVisitados($idPontoTuristico, $pesquisa, $url)
    {
        $idUser = Yii::$app->user->getId();

        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $idPontoTuristico]);

        if ($pontoTuristico != null && $idUser != null) {
            $visitado = new Visitados();

            $visitado->user_idUtilizador = $idUser;
            $visitado->pt_idPontoTuristico = $pontoTuristico->id_pontoTuristico;

            $visitado->save();
        }
        if ($url == 'cultravel/ponto-interesse-details') {
            return $this->redirect(['ponto-interesse-details', 'pesquisa' => $pesquisa, 'id' => $idPontoTuristico]);
        } else if ($url == 'cultravel/visitados') {
            return $this->redirect(['visitados']);
        } else {
            Yii::$app->session->setFlash('error', 'Não foi possível adicionar este ponto turistico aos visitados!');
            return $this->redirect(['index']);
        }
    }

    public
    function actionRemoverVisitados($idPontoTuristico, $pesquisa, $url)
    {
        $idUser = Yii::$app->user->getId();

        $localidade = Localidade::find()->where(['nomeLocalidade' => $pesquisa])->one();

        $visitados = Visitados::find()
            ->where(['pt_idPontoTuristico' => $idPontoTuristico])
            ->andwhere(['user_idUtilizador' => $idUser])
            ->one();

        if ($visitados != null && $idUser != null) {
            $visitados->delete();
        }
        if ($url == 'cultravel/ponto-interesse-details') {
            return $this->redirect(['ponto-interesse-details', 'pesquisa' => $pesquisa, 'id' => $idPontoTuristico]);
        } else if ($url == 'cultravel/ponto-interesse-visitados') {
            return $this->redirect(['ponto-interesse-visitados', 'idLocalidade' => $localidade->id_localidade]);
        } else {
            Yii::$app->session->setFlash('error', 'Não foi possível remover este ponto turistico dos visitados!');
            return $this->redirect(['index']);
        }
    }

}