<?php

namespace backend\controllers;

use common\models\Pontosturisticos;
use Yii;
use common\models\Tipomonumento;
use app\models\TipomonumentoSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipomonumentoController implements the CRUD actions for Tipomonumento model.
 */
class TipomonumentoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Tipomonumento models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['cultravel/login']);
        } else {
            $searchModel = new TipomonumentoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Tipomonumento model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tipomonumento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('criarPi')) {

            $model = new Tipomonumento();

            if ($model->load(Yii::$app->request->post())) {
                $verificaTM = $this->verificaTipoMonumento($model);
                if ($verificaTM == true) {
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Tipo monumento já registado!');
                    return $this->redirect(['index']);
                }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para editar este Tipo de Monumento!');
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Tipomonumento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('editarPi')) {

            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                if ($model->descricao != Yii::$app->request->post('Tipomonumento')['descricao']) {
                    $verificaTM = $this->verificaTipoMonumento($model);
                    if ($verificaTM != true) {
                        Yii::$app->session->setFlash('error', 'Tipo monumento já registado!');
                    }else{
                        Yii::$app->session->setFlash('error', 'Tipo monumento alterado com sucesso!');
                    }
                }
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para editar este Tipo de Monumento!');
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing Tipomonumento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarPi')) {

            $pontosTuristicos = Pontosturisticos::find()
                ->where(['tm_idTipoMonumento' => $id])
                ->all();

            if ($pontosTuristicos == null) {
                $this->findModel($id)->delete();
            } else {
                Yii::$app->session->setFlash('error', 'Este Tipo de Monumento está associado a pontos turísticos, não pode ser apagado!');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para apagar este Tipo de Monumento!');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Tipomonumento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tipomonumento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tipomonumento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function verificaTipoMonumento($tipoMonumento)
    {
        $tipoMonumentoVerifica = Tipomonumento::findOne(['descricao' => $tipoMonumento->descricao]);
        if ($tipoMonumentoVerifica == null) {
            $tipoMonumento->save();
            return true;
        } else {
            return false;
        }
    }
}
