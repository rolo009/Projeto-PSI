<?php

namespace app\controllers;
namespace backend\controllers;

use app\models\Userprofile;
use Cassandra\Date;
use Yii;
use common\models\User;
use app\models\UserSearch;
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        $userProfile= Userprofile::findOne(['id_userProfile' => $id]);

        $user= User::findOne(['id' => $id]);

        if($user->status == 9){
            $estadoUser = "Utilizador inativo (9)";
        }
        elseif ($user->status == 10){
            $estadoUser = "Utilizador ativo (10)";
        }

        elseif ($user->status == 0){
            $estadoUser = "Utilizador banido (0)";
        }

        return $this->render('view', [
            'model' => $model,
            'userProfile' => $userProfile,
            'estadoUser' => $estadoUser,
        ]);
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
        $this->findModel($id)->delete();

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

        return $this->render('stats-users', [
            'nUsersMasculinos' => $nUsersMasculinos,
            'nUsersFemininos' => $nUsersFemininos,
            'nUsersFemininos' => $nUsersFemininos,
            'idadesUsers' => $idadesUsers,
        ]);
    }

    public function usersMasculinos(){
        $usersMasculinos = Userprofile::find()
        ->where(['sexo' => 'Masculino'])
        ->count();

        return $usersMasculinos;
    }

    public function usersFemininos(){
        $usersFemininos = Userprofile::find()
        ->where(['sexo' => 'Feminino'])
        ->count();

        return $usersFemininos;
    }

    public function usersIdades(){

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

            if($idade->y >= 0 && $idade->y < 20){
                $idade0a20++;
            }
            elseif ($idade->y >= 20 && $idade->y <30){
                $idade20a30++;
            }
            elseif ($idade->y >= 30 && $idade->y <40){
                $idade30a40++;
            }
            elseif ($idade->y >= 40 && $idade->y <60){
                $idade40a60++;
            }
            elseif ($idade->y >= 60 && $idade->y <75){
                $idade60a75++;
            }
            elseif ($idade->y >= 75){
                $idadeMais75++;
            }

            $idades = array('idade0a20' => $idade0a20, 'idade20a30' => $idade20a30, 'idade30a40' => $idade30a40,
                'idade40a60' => $idade40a60, 'idade60a75' => $idade60a75, 'idadeMais75' => $idadeMais75);

        }

        return $idades;
    }

}
