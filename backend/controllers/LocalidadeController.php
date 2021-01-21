<?php

namespace backend\controllers;

use app\models\UploadFormLocalidade;
use app\models\UploadFormPontosTuristicos;
use common\models\Pontosturisticos;
use Yii;
use common\models\Localidade;
use app\models\LocalidadeSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LocalidadeController implements the CRUD actions for Localidade model.
 */
class LocalidadeController extends Controller
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
                        'actions' => ['index'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Localidade models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['cultravel/login']);
        } else {
            $searchModel = new LocalidadeSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Localidade model.
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
     * Creates a new Localidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('criarPi')) {

            $model = new Localidade();
            $modelUpload = new UploadFormLocalidade();

            if ($model->load(Yii::$app->request->post())) {
                $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
                $modelUpload->uploadFrontend();
                $localidadeVerifica = Localidade::findOne(['nomeLocalidade' => $model->nomeLocalidade]);
                if ($localidadeVerifica == null) {
                    $model->save();
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Localidade já registada!');
                    return $this->redirect(['index']);
                }
            }

            return $this->render('create', [
                'model' => $model,
                'modelUpload' => $modelUpload,
            ]);

        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing Localidade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelUpload = new UploadFormLocalidade();
        if ($model->load(Yii::$app->request->post())) {
            $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
            $modelUpload->uploadFrontend();
            $localidadeVerifica = Localidade::findOne(['nomeLocalidade' => $model->nomeLocalidade]);
            if ($localidadeVerifica == null) {
                $model->save();
                return $this->redirect(['index', 'id' => $model->id_localidade]);
            } else {
                Yii::$app->session->setFlash('error', 'Localidade já registada!');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelUpload' => $modelUpload,
        ]);
    }

    /**
     * Deletes an existing Localidade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarPi')) {
            $pontoTuristicoSearch = Pontosturisticos::find()->where(['localidade_idLocalidade' => $id])->all();
            if ($pontoTuristicoSearch == null) {
                $this->findModel($id)->delete();
                return $this->redirect(['index']);

            } else {
                Yii::$app->session->setFlash('error', 'Não é possivel apagar este estilo de construção porque é está a ser utilizado por um ponto turistico');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Localidade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Localidade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Localidade::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
