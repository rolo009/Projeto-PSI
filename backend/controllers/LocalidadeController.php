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
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
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
     * Creates a new Localidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('criarPi')) {

            $model = new Localidade();
            $modelUpload = new UploadFormLocalidade();

            if ($model->load(Yii::$app->request->post()) && $modelUpload->load(Yii::$app->request->post())) {

                $verificaL = $this->verificaLocalidade($model);
                if ($verificaL == true) {
                    $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
                    $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
                    $modelUpload->upload();

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
            Yii::$app->session->setFlash('error', 'Não tem permissões para registar uma nova Localidade!');
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
        if (Yii::$app->user->can('editarPi')) {

            $model = $this->findModel($id);
            $modelUpload = new UploadFormLocalidade();

            if ($model->load(Yii::$app->request->post())) {
                if ($model->nomeLocalidade != Yii::$app->request->post('Localidade')['nomeLocalidade']) {
                    $verificaL = $this->verificaLocalidade($model);
                    if ($verificaL == true) {
                        if (UploadedFile::getInstance($modelUpload, 'imageFile') != null) {
                            unlink('imagens/img-localidade/' . $model->foto);
                            $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
                            $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
                            $modelUpload->upload();
                            Yii::$app->session->setFlash('error', 'Localidade alterada com sucesso!');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Localidade já registada!');
                    }
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'modelUpload' => $modelUpload,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para editar esta Localidade!');
        }
        return $this->redirect(['index']);

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
            } else {
                Yii::$app->session->setFlash('error', 'Não é possivel apagar esta localidade porque é está a ser utilizado por um ponto turistico');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para editar esta Localidade!');
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

    public function verificaLocalidade($localidade)
    {
        $localidadeVerifica = Localidade::find()
            ->where(['nomeLocalidade' => $localidade->nomeLocalidade])
            ->one();

        if ($localidadeVerifica == null) {
            $localidade->save();
            return true;
        } else {
            return false;
        }
    }
}
