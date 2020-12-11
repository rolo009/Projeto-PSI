<?php

namespace backend\controllers;



use common\models\Estiloconstrucao;
use common\models\Localidade;
use common\models\Tipomonumento;
use app\models\UploadForm;
use app\models\UserSearch;
use common\models\LoginForm;
use Yii;
use yii\debug\models\search\User;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class CultravelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->getUser()->can('admin')){
                return $this->goBack();
            }
            else{
                Yii::$app->user->logout();
                return $this->goHome();
            }
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionEditarTipoMonumento($id)
    {
        $model = new Tipomonumento();

        if ($model->load(Yii::$app->request->post())) {

            $tipoMonumentoVerifica = Tipomonumento::findOne(['descricao' => $model->descricao]);

            if ($tipoMonumentoVerifica == null){
                $model->save();
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            }
            else{
                Yii::$app->session->setFlash('error','Tipo monumento já registado!');
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            }
        }
        return $this->render('registar-tipo-monumento', [
            'model' => $model,
        ]);
    }

    public function actionRegistarTipoMonumento()
    {
        $model = new Tipomonumento();

        if ($model->load(Yii::$app->request->post())) {
            $tipoMonumentoVerifica = Tipomonumento::findOne(['descricao'=>$model->descricao]);
            if ($tipoMonumentoVerifica == null){
                $model->save();
                return $this->redirect(['pontosturisticos/create']);
            }
            else{
                Yii::$app->session->setFlash('error','Tipo monumento já registado!');
                return $this->redirect(['pontosturisticos/create']);
            }
        }
        return $this->render('registar-tipo-monumento', [
            'model' => $model,
        ]);
    }

    public function actionRegistarEstiloConstrucao()
    {
        $model = new Estiloconstrucao();

        if ($model->load(Yii::$app->request->post())) {

            $estiloConstrucaoVerifica = Estiloconstrucao::findOne(['descricao'=>$model->descricao]);
            if ($estiloConstrucaoVerifica == null){
                $model->save();
                return $this->redirect(['pontosturisticos/create']);
            }
            else{
                Yii::$app->session->setFlash('error','Estilo de Construção já registado!');
                return $this->redirect(['pontosturisticos/create']);
            }
        }
        return $this->render('registar-estilo-construcao', [
            'model' => $model,
        ]);
    }

    public function actionEditarEstiloConstrucao($id)
    {
        $model = new Estiloconstrucao();

        if ($model->load(Yii::$app->request->post())) {
            $estiloConstrucaoVerifica = Estiloconstrucao::findOne(['descricao'=>$model->descricao]);
            if ($estiloConstrucaoVerifica == null){
                $model->save();
                return $this->redirect(['pontosturisticos/create']);
            }
            else{
                Yii::$app->session->setFlash('error','Estilo de Construção já registado!');
                return $this->redirect(['pontosturisticos/create']);
            }
        }
        return $this->render('registar-estilo-construcao', [
            'model' => $model,
        ]);
    }

    public function actionRegistarLocalidade()
    {
        $model = new Localidade();
        $modelUpload = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
            $modelUpload->upload();
            $localidadeVerifica = Localidade::findOne(['nomeLocalidade'=>$model->nomeLocalidade]);
            if ($localidadeVerifica == null){
                $model->save();
                return $this->redirect(['pontosturisticos/create']);
            }
            else{
                Yii::$app->session->setFlash('error','Localidade já registada!');
                return $this->redirect(['pontosturisticos/create']);
            }
        }
        return $this->render('registar-localidade', [
            'model' => $model,
            'modelUpload' => $modelUpload,
        ]);
    }

    public function actionEditarLocalidade($id)
    {
        $model = new Localidade();

        if ($model->load(Yii::$app->request->post())) {
            $localidadeVerifica = Localidade::findOne(['nomeLocalidade'=>$model->nomeLocalidade]);
            if ($localidadeVerifica == null){
                $model->save();
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            }
            else{
                Yii::$app->session->setFlash('error','Localidade já registada!');
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            }
        }
        return $this->render('registar-localidade', [
            'model' => $model,
        ]);
    }


}
