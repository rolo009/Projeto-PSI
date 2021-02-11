<?php

namespace backend\controllers;

use common\models\Pontosturisticos;
use Mpdf\Tag\VarTag;
use Yii;
use common\models\Estiloconstrucao;
use app\models\EstiloconstrucaoSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstiloconstrucaoController implements the CRUD actions for Estiloconstrucao model.
 */
class EstiloconstrucaoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete'],
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
     * Lists all Estiloconstrucao models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['cultravel/login']);
        } else {
            $searchModel = new EstiloconstrucaoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Estiloconstrucao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('criarPi')) {

            $model = new Estiloconstrucao();

            if ($model->load(Yii::$app->request->post())) {
                $verificaEC = $this->verificaEstiloConstrucao($model);
                if ($verificaEC == true) {
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Estilo de Construção já registado!');
                    return $this->redirect(['index']);
                }
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Estiloconstrucao model.
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
                if ($model->descricao != Yii::$app->request->post('Estiloconstrucao')['descricao']) {
                    $verificaEC = $this->verificaEstiloConstrucao($model);
                    if ($verificaEC != true) {
                        Yii::$app->session->setFlash('error', 'Estilo de Construção já registado!');
                    }else{
                        Yii::$app->session->setFlash('error', 'Estilo de Construção alterado com sucesso!');
                    }
                }
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para editar este Estilo de Construção!');
        }
        return $this->redirect(['index']);
    }


    /**
     * Deletes an existing Estiloconstrucao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarPi')) {

            $pontoTuristicoSearch = Pontosturisticos::find()
                ->where(['ec_idEstiloConstrucao' => $id])
                ->all();

            if ($pontoTuristicoSearch == null) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Este Estilo de Construção está associado a pontos turísticos, não pode ser apagado!');
            }

        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Estiloconstrucao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estiloconstrucao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estiloconstrucao::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function verificaEstiloConstrucao($estiloConstrucao)
    {
        $estiloConstrucaoVerifica = Estiloconstrucao::find()
            ->where(['descricao' => $estiloConstrucao->descricao])
            ->one();

        if ($estiloConstrucaoVerifica == null) {
            $estiloConstrucao->save();
            return true;
        } else {
            return false;
        }
    }
}
