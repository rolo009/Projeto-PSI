<?php

namespace app\controllers;
namespace backend\controllers;

use Yii;
use app\models\Contactos;
use app\models\ContactosSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactosController implements the CRUD actions for Contactos model.
 */
class ContactosController extends Controller
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
     * Lists all Contactos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contactos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $mensagem = Contactos::findOne(['idContactos' => $id]);

        if($mensagem->status == 0){
            $estadoMensagem = 'Mensagem não Lida (0)';
        }
        elseif ($mensagem->status == 1){
            $estadoMensagem = 'Mensagem Lida (1)';
        }


        if ($model->load(Yii::$app->request->post())) {

            if($model->status == 0){
                $model->dataResposta = NULL;
                $model->save();
            }
            elseif ($model->status == 1){
                $model->dataResposta = date('Y-m-d H:i:s');
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->idContactos]);
        }

        return $this->render('view', [
            'model' => $model,
            'estadoMensagem' =>$estadoMensagem,
        ]);
    }

    /**
     * Creates a new Contactos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contactos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idContactos]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contactos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idContactos]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contactos model.
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
     * Finds the Contactos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contactos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contactos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
