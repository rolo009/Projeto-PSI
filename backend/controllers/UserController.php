<?php

namespace app\controllers;

namespace backend\controllers;

use common\models\Userprofile;
use Cassandra\Date;
use Yii;
use common\models\User;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'remover-admin', 'tornar-admin', 'create', 'update', 'delete', 'estatisticas'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'remover-admin', 'tornar-admin', 'create', 'update', 'delete', 'estatisticas'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('gerirUsers')) {

            if (Yii::$app->user->isGuest == true) {
                return $this->redirect(['cultravel/login']);
            } else {
                $searchModel = new UserSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            return $this->redirect(['cultravel/index']);
        }
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $user = User::findOne(['id' => $id]);
        //$userProfile = $user->userprofile;
        $userProfile = Userprofile::find()->where(['id_user_rbac' => $user->id])->one();



        if (Yii::$app->authManager->checkAccess($user->id, 'admin') == true) {
            $permissaoUser = "Administrador";
        } elseif (Yii::$app->authManager->checkAccess($user->id, 'user') == true) {
            $permissaoUser = "Utilizador";
        } elseif (Yii::$app->authManager->checkAccess($user->id, 'moderador') == true) {
            $permissaoUser = "Moderador";
        }

        return $this->render('view', [
            'model' => $model,
            'userProfile' => $userProfile,
            'permissaoUser' => $permissaoUser,
        ]);
    }

    public function actionRemoverAdmin($id)
    {
        if (Yii::$app->user->can('gerirCargos')) {
            $userID =  Yii::$app->user->getId();
            $roleAdmin = Yii::$app->authManager->getRole('admin');
            $roleUser = Yii::$app->authManager->getRole('user');

            Yii::$app->authManager->revoke($roleAdmin, $id);
            if (Yii::$app->authManager->assign($roleUser, $id) == true) {
                if (Yii::$app->authManager->checkAccess($userID, 'admin') == true || Yii::$app->authManager->checkAccess($userID, 'moderador') == true) {
                    return $this->actionView($id);
                }else{
                    return $this->redirect(['cultravel/logout']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Não foi possivel tornar este utilizador Administrador!');
                return $this->actionView($id);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para remover Administradores!');
            return $this->actionIndex();
        }
    }

    public function actionTornarAdmin($id)
    {
        if (Yii::$app->user->can('gerirCargos')) {

            $roleAdmin = Yii::$app->authManager->getRole('admin');
            $roleUser = Yii::$app->authManager->getRole('user');

            Yii::$app->authManager->revoke($roleUser, $id);
            if (Yii::$app->authManager->assign($roleAdmin, $id) == true) {
                return $this->actionView($id);
            } else {
                Yii::$app->session->setFlash('error', 'Não foi possivel tornar este utilizador Administrador!');
                return $this->actionView($id);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para adicionar Administradores!');
            return $this->actionIndex();
        }
    }


    public function actionRemoverMod($id)
    {
        if (Yii::$app->user->can('gerirCargos')) {

            $userID =  Yii::$app->user->getId();
            $roleMod = Yii::$app->authManager->getRole('moderador');
            $roleUser = Yii::$app->authManager->getRole('user');

            Yii::$app->authManager->revoke($roleMod, $id);
            if (Yii::$app->authManager->assign($roleUser, $id) == true) {
                if (Yii::$app->authManager->checkAccess($userID, 'admin') == true || Yii::$app->authManager->checkAccess($userID, 'moderador') == true) {
                    return $this->actionView($id);
                }else{
                    return $this->redirect(['cultravel/logout']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Não foi possivel tornar este utilizador Moderador!');
                return $this->actionView($id);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para adicionar Administradores!');
            return $this->actionIndex();
        }
    }

    public function actionTornarMod($id)
    {
        if (Yii::$app->user->can('gerirCargos')) {

            $roleMod = Yii::$app->authManager->getRole('moderador');
            $roleUser = Yii::$app->authManager->getRole('user');

            Yii::$app->authManager->revoke($roleUser, $id);
            if (Yii::$app->authManager->assign($roleMod, $id) == true) {
                return $this->actionView($id);
            } else {
                Yii::$app->session->setFlash('error', 'Não foi possivel tornar este utilizador Moderador!');
                return $this->actionView($id);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para adicionar Administradores!');
            return $this->actionIndex();
        }
    }


    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = User::findOne(['id' => $id]);

        $user->status = 1;

        $user->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEstatisticas()
    {
        $nUsersMasculinos = $this->usersMasculinos();
        $nUsersFemininos = $this->usersFemininos();

        $idadesUsers = $this->usersIdades();
        $distritoUsers = $this->usersDistrito();

        return $this->render('stats-users', [
            'nUsersMasculinos' => $nUsersMasculinos,
            'nUsersFemininos' => $nUsersFemininos,
            'nUsersFemininos' => $nUsersFemininos,
            'idadesUsers' => $idadesUsers,
            'distritosUsers' => $distritoUsers,
        ]);
    }

    public function usersMasculinos()
    {
        $usersMasculinos = Userprofile::find()
            ->where(['sexo' => 'Masculino'])
            ->count();

        return $usersMasculinos;
    }

    public function usersFemininos()
    {
        $usersFemininos = Userprofile::find()
            ->where(['sexo' => 'Feminino'])
            ->count();

        return $usersFemininos;
    }

    public function usersIdades()
    {

        $users = Userprofile::find()->all();
        $idade0a20 = 0;
        $idade20a30 = 0;
        $idade30a40 = 0;
        $idade40a60 = 0;
        $idade60a75 = 0;
        $idadeMais75 = 0;
        foreach ($users as $user) {
            $dataNascimento = new \DateTime($user->dtaNascimento);
            $dataAtual = new \DateTime();
            //Yii::$app->formatter->asDate('now', 'php:Y-m-d');

            $idade = $dataNascimento->diff($dataAtual);

            if ($idade->y >= 0 && $idade->y < 20) {
                $idade0a20++;
            } elseif ($idade->y >= 20 && $idade->y < 30) {
                $idade20a30++;
            } elseif ($idade->y >= 30 && $idade->y < 40) {
                $idade30a40++;
            } elseif ($idade->y >= 40 && $idade->y < 60) {
                $idade40a60++;
            } elseif ($idade->y >= 60 && $idade->y < 75) {
                $idade60a75++;
            } elseif ($idade->y >= 75) {
                $idadeMais75++;
            }

            $idades = array('idade0a20' => $idade0a20, 'idade20a30' => $idade20a30, 'idade30a40' => $idade30a40,
                'idade40a60' => $idade40a60, 'idade60a75' => $idade60a75, 'idadeMais75' => $idadeMais75);

        }

        return $idades;
    }

    public function usersDistrito()
    {
        $users = Userprofile::find()->all();
        $userVianaDoCastelo = 0;
        $userBraga = 0;
        $userVilaReal = 0;
        $userBraganca = 0;
        $userPorto = 0;
        $userAveiro = 0;
        $userViseu = 0;
        $userGuarda = 0;
        $userCoimbra = 0;
        $userCasteloBranco = 0;
        $userLeiria = 0;
        $userSantarem = 0;
        $userPortalegre = 0;
        $userLisboa = 0;
        $userEvora = 0;
        $idadeSetubal = 0;
        $idadeBeja = 0;
        $idadeFaro = 0;
        $idadeAcores = 0;
        $idadeMadeira = 0;

        foreach ($users as $user) {
            if ($user->distrito == 'Viana do Castelo') {
                $userVianaDoCastelo++;
            } elseif ($user->distrito == 'Braga') {
                $userBraga++;
            } elseif ($user->distrito == 'Vila Real') {
                $userVilaReal++;
            } elseif ($user->distrito == 'Bragança') {
                $userBraganca++;
            } elseif ($user->distrito == 'Porto') {
                $userPorto++;
            } elseif ($user->distrito == 'Aveiro') {
                $userAveiro++;
            } elseif ($user->distrito == 'Viseu') {
                $userViseu++;
            } elseif ($user->distrito == 'Guarda') {
                $userGuarda++;
            } elseif ($user->distrito == 'Coimbra') {
                $userCoimbra++;
            } elseif ($user->distrito == 'Castelo Branco') {
                $userCasteloBranco++;
            } elseif ($user->distrito == 'Leiria') {
                $userLeiria++;
            } elseif ($user->distrito == 'Santarém') {
                $userSantarem++;
            } elseif ($user->distrito == 'Portalegre') {
                $userPortalegre++;
            } elseif ($user->distrito == 'Leiria') {
                $userLisboa++;
            } elseif ($user->distrito == 'Setubal') {
                $idadeSetubal++;
            } elseif ($user->distrito == 'Évora') {
                $userEvora++;
            } elseif ($user->distrito == 'Beja') {
                $idadeBeja++;
            } elseif ($user->distrito == 'Coimbra') {
                $idadeFaro++;
            } elseif ($user->distrito == 'Açores') {
                $idadeAcores++;

            } elseif ($user->distrito == 'Madeira') {
                $idadeMadeira++;
            }

            $distritos = array('VianaDoCastelo' => $userVianaDoCastelo,
                'Braga' => $userBraga,
                'VilaReal' => $userVilaReal,
                'Braganca' => $userBraganca,
                'Porto' => $userPorto,
                'Aveiro' => $userAveiro,
                'Viseu' => $userViseu,
                'Guarda' => $userGuarda,
                'Coimbra' => $userCoimbra,
                'CasteloBranco' => $userCasteloBranco,
                'Leiria' => $userLeiria,
                'Santarem' => $userSantarem,
                'Portalegre' => $userPortalegre,
                'Lisboa' => $userLisboa,
                'Evora' => $userEvora,
                'Setubal' => $idadeSetubal,
                'Beja' => $idadeBeja,
                'Faro' => $idadeFaro,
                'Acores' => $idadeAcores,
                'Madeira' => $idadeMadeira);
        }

        return $distritos;

    }
}
