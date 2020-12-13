<?php

namespace app\controllers;

namespace backend\controllers;


use common\models\Estiloconstrucao;
use common\models\Favoritos;
use common\models\Localidade;
use common\models\Ratings;
use common\models\Tipomonumento;
use app\models\UploadForm;
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
                        'actions' => ['index'],
                        'roles' => ['?'],
                    ],
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
        $localidade = Localidade::findOne(['id_localidade' => $pontoTuristico->localidade_idLocalidade]);
        $estiloConstrucao = Estiloconstrucao::findOne(['idEstiloConstrucao' => $pontoTuristico->ec_idEstiloConstrucao]);
        $tipoMonumento = Tipomonumento::findOne(['idTipoMonumento' => $pontoTuristico->tm_idTipoMonumento]);

        $favoritosContador = count(Favoritos::findAll(['pt_idPontoTuristico' => $id]));
        $visitadosContador = count(Visitados::findAll(['pt_idPontoTuristico' => $id]));

        $ratings = Ratings::findAll(['pt_idPontoTuristico' => $pontoTuristico->id_pontoTuristico]);
        if ($ratings != null) {
            $mediaRatings = $this->mediaRatings($ratings);
        } elseif ($ratings == null) {
            $mediaRatings = 0;
        }

        if ($pontoTuristico->status == 1) {
            $estadoPontoTuristico = "Ativo";
        } elseif ($pontoTuristico->status == 0) {
            $estadoPontoTuristico = "Inativo";
        }


        return $this->render('view', [
            'model' => $this->findModel($id),
            'localidade' => $localidade,
            'estiloConstrucao' => $estiloConstrucao,
            'tipoMonumento' => $tipoMonumento,
            'mediaRatings' => $mediaRatings,
            'favoritosContador' => $favoritosContador,
            'visitadosContador' => $visitadosContador,
            'estadoPontoTuristico' => $estadoPontoTuristico,

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
        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $id]);
        $pontoTuristico->status = 1;
        if ($pontoTuristico->save() == true) {
            return $this->actionView($id);
        } else {
            Yii::$app->session->setFlash('error', 'Não foi possivel tornar este Ponto Turistico Inativo!');
            return $this->actionView($id);
        }
    }

    public function actionUpdatePtInativo($id)
    {
        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $id]);
        $pontoTuristico->status = 0;
        if ($pontoTuristico->save() == true) {
            return $this->actionView($id);
        } else {
            Yii::$app->session->setFlash('error', 'Não foi possivel tornar este Ponto Turistico Ativo!');
            return $this->actionView($id);
        }
    }

    /**
     * Creates a new pontosturisticos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pontosturisticos();
        $modelUpload = new UploadForm();

        if ($model->load(Yii::$app->request->post()) && $modelUpload->load(Yii::$app->request->post())) {
            $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
            $modelUpload->upload();
            $model->status = 1;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_pontoTuristico]);
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
        $model = $this->findModel($id);
        $modelUpload = new UploadForm();
        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $id]);
        $localidade = Localidade::findOne(['id_localidade' => $pontoTuristico->localidade_idLocalidade]);
        $estiloConstrucao = Estiloconstrucao::findOne(['idEstiloConstrucao' => $pontoTuristico->ec_idEstiloConstrucao]);
        $tipoMonumento = Tipomonumento::findOne(['idTipoMonumento' => $pontoTuristico->tm_idTipoMonumento]);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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


    public function actionEstatisticas()
    {

        $ptMaisVisitado = $this->pontoTuristicoMaisVisitado();
        $ptMenosVisitado = $this->pontoTuristicoMenosVisitado();

        return $this->render('stats-pontosTuristicos', [
        ]);
    }

    public function pontoTuristicoMaisVisitado()
    {

    }

    private function pontoTuristicoMenosVisitado()
    {

    }
}
