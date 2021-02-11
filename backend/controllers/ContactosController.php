<?php

namespace backend\controllers;

use Yii;
use common\models\Contactos;
use app\models\ContactosSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['cultravel/login']);
        } else {
            $searchModel = new ContactosSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Contactos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->can('gerirMensagens')) {

            $model = $this->findModel($id);

            $mensagem = Contactos::findOne(['idContactos' => $id]);

            if ($model->load(Yii::$app->request->post())) {

                if ($model->status == 0) {
                    $model->dataResposta = NULL;
                    $model->save();
                } elseif ($model->status == 1) {
                    $model->dataResposta = date('Y-m-d H:i:s');
                    $model->save();
                }
                return $this->redirect(['view', 'id' => $model->idContactos]);
            }
            return $this->render('view', [
                'model' => $model,
                'estadoMensagem' => $mensagem->estado,
            ]);
        } else {
            return $this->redirect(['index']);
        }
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
