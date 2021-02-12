<?php

namespace app\controllers;

namespace backend\controllers;


use common\models\Estiloconstrucao;
use common\models\Favoritos;
use common\models\Localidade;
use common\models\Ratings;
use common\models\Tipomonumento;
use app\models\UploadFormPontosTuristicos;
use common\models\Visitados;
use Yii;
use common\models\Pontosturisticos;
use app\models\PontosturisticosSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * PontosturisticosController implements the CRUD actions for pontosturisticos model.
 */
class PontosturisticosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'update-pt-ativo', 'update-pt-inativo', 'create', 'update', 'delete', 'estatisticas'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update-pt-ativo', 'update-pt-inativo', 'create', 'update', 'delete', 'estatisticas'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all pontosturisticos models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest == true) {
            return $this->redirect(['cultravel/login']);
        } else {
            $searchModel = new PontosturisticosSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single pontosturisticos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $id]);
        $favoritosContador = count($pontoTuristico->favoritos);
        $visitadosContador = count($pontoTuristico->visitados);

        $ratings = $pontoTuristico->ratings;
        if ($ratings != null) {
            $mediaRatings = $this->mediaRatings($ratings);
        } elseif ($ratings == null) {
            $mediaRatings = 0;
        }

        return $this->render('view', [
            'pontoTuristico' => $pontoTuristico,
            'mediaRatings' => $mediaRatings,
            'favoritosContador' => $favoritosContador,
            'visitadosContador' => $visitadosContador,
        ]);
    }

    public function mediaRatings($ratings)
    {
        $somaRatings = 0;

        foreach ($ratings as $rating) {
            $somaRatings = $somaRatings + $rating->classificacao;
        }
        $mediaRatings = $somaRatings / count($ratings);
        return $mediaRatings;
    }

    public function actionUpdatePtAtivo($id)
    {
        $pontoTuristico = Pontosturisticos::find()->where(['id_pontoTuristico' => $id])->one();
        $pontoTuristico->status = 1;
        if (!$pontoTuristico->save(false)) {
            Yii::$app->session->setFlash('error', 'Não foi possivel tornar este Ponto Turistico Inativo!');
        }
        return $this->redirect(['view', 'id' => $id]);

    }

    public function actionUpdatePtInativo($id)
    {
        $pontoTuristico = Pontosturisticos::find()->where(['id_pontoTuristico' => $id])->one();
        $pontoTuristico->status = 0;
        if (!$pontoTuristico->save(false)) {

            Yii::$app->session->setFlash('error', 'Não foi possivel tornar este Ponto Turistico Ativo!');
        }
        return $this->redirect(['view', 'id' => $id]);

    }

    /**
     * Creates a new pontosturisticos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->can('criarPi')) {

            $model = new Pontosturisticos();
            $modelUpload = new UploadFormPontosTuristicos();

            if ($model->load(Yii::$app->request->post()) && $modelUpload->load(Yii::$app->request->post())) {
                if(UploadedFile::getInstance($modelUpload, 'imageFile') != null){
                    $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
                    $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
                    $modelUpload->upload();
                    $model->status = 1;
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->id_pontoTuristico]);
                }else{
                    Yii::$app->session->setFlash('error', 'O campo imagem não foi preenchido!');
                    return $this->redirect(['create']);
                }
            }

            $tiposMonumentos = Tipomonumento::find()
                ->select(['descricao'])
                ->indexBy('idTipoMonumento')
                ->column();

            $estiloConstrucao = Estiloconstrucao::find()
                ->select(['descricao'])
                ->indexBy('idEstiloConstrucao')
                ->column();

            $localidade = Localidade::find()
                ->select(['nomeLocalidade'])
                ->indexBy('id_localidade')
                ->column();

            return $this->render('create', [
                'model' => $model,
                'modelUpload' => $modelUpload,
                'tiposMonumentosPT' => $tiposMonumentos,
                'localidadePT' => $localidade,
                'estiloConstrucaoPT' => $estiloConstrucao,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para criar um novo Ponto Turistico!');
            return $this->redirect(['index']);
        }
    }

    /**
     * Updates an existing pontosturisticos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('editarPi')) {

            $model = $this->findModel($id);
            $modelUpload = new UploadFormPontosTuristicos();

            if ($model->load(Yii::$app->request->post()) && $modelUpload->load(Yii::$app->request->post())) {
                if(UploadedFile::getInstance($modelUpload, 'imageFile') != null){
                    unlink('imagens/img-pt/' . $model->foto);
                    $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
                    $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
                    $modelUpload->upload();
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id_pontoTuristico]);
            }

            $tiposMonumentosPT = \common\models\Tipomonumento::find()
                ->select(['descricao'])
                ->indexBy('idTipoMonumento')
                ->orderBy('descricao ASC')
                ->column();

            $estiloConstrucaoPT = \common\models\Estiloconstrucao::find()
                ->select(['descricao'])
                ->indexBy('idEstiloConstrucao')
                ->orderBy('descricao ASC')
                ->column();

            $localidadePT = \common\models\Localidade::find()
                ->select(['nomeLocalidade'])
                ->indexBy('id_localidade')
                ->orderBy('nomeLocalidade ASC')
                ->column();

            return $this->render('update', [
                'model' => $model,
                'modelUpload' => $modelUpload,
                'tiposMonumentosPT' => $tiposMonumentosPT,
                'localidadePT' => $localidadePT,
                'estiloConstrucaoPT' => $estiloConstrucaoPT,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Não tem permissões para editar este Ponto Turistico!');
            return $this->redirect(['index']);
        }

    }

    /**
     * Deletes an existing pontosturisticos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->can('eliminarPi')) {

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            Yii::$app->session->setFlash('error', 'Não tem permissões para apagar este Ponto Turistico!');
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the pontosturisticos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pontosturisticos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pontosturisticos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
