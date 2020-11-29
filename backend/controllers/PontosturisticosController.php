<?php

namespace app\controllers;
namespace backend\controllers;


use app\models\Estiloconstrucao;
use app\models\Localidade;
use app\models\Ratings;
use app\models\Tipomonumento;
use Yii;
use app\models\Pontosturisticos;
use app\models\PontosturisticosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
        $searchModel = new PontosturisticosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

        $ratings = Ratings::findAll(['pt_idPontoTuristico' => $pontoTuristico->id_pontoTuristico]);
        if($ratings != null){
            $mediaRatings = $this->mediaRatings($ratings);
        }
        elseif($ratings == null){
            $mediaRatings = 0;
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'localidade' => $localidade,
            'estiloConstrucao' => $estiloConstrucao,
            'tipoMonumento' => $tipoMonumento,
            'mediaRatings' => $mediaRatings,

        ]);
    }

    public function mediaRatings($ratings)
    {
        $somaRatings = 0;

        foreach ($ratings as $rating) {
            $somaRatings = $somaRatings = $rating->classificacao;
        }
        $mediaRatings = $somaRatings/count($ratings);
        return $mediaRatings;
    }

    /**
     * Creates a new pontosturisticos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pontosturisticos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pontoTuristico]);
        }

        return $this->render('create', [
            'model' => $model,
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
        $pontoTuristico = Pontosturisticos::findOne(['id_pontoTuristico' => $id]);
        $localidade = Localidade::findOne(['id_localidade' => $pontoTuristico->localidade_idLocalidade]);
        $estiloConstrucao = Estiloconstrucao::findOne(['idEstiloConstrucao' => $pontoTuristico->ec_idEstiloConstrucao]);
        $tipoMonumento = Tipomonumento::findOne(['idTipoMonumento' => $pontoTuristico->tm_idTipoMonumento]);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_pontoTuristico]);
        }

        return $this->render('update', [
            'model' => $model,
            'localidade' => $localidade,
            'estiloConstrucao' => $estiloConstrucao,
            'tipoMonumento' => $tipoMonumento,
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
}
