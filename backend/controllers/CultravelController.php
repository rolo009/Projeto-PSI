<?php

namespace backend\controllers;


use common\models\Estiloconstrucao;
use common\models\Localidade;
use common\models\Tipomonumento;
use app\models\UploadFormPontosTuristicos;
use common\models\User;
use app\models\UserSearch;
use common\models\LoginForm;
use Yii;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

class CultravelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->getId();
        if (Yii::$app->authManager->checkAccess($user, 'admin') == true || Yii::$app->authManager->checkAccess($user, 'moderador') == true) {
            return $this->render('index');
        }else{
            return $this->redirect(['login']);
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = User::find()->where(['email' => $model->email])->one();
            if (Yii::$app->authManager->checkAccess($user->id, 'admin') == true || Yii::$app->authManager->checkAccess($user->id, 'moderador') == true) {
                $model->login();
                $this->layout = 'main';

                return $this->render('index');
            } else {
                return $this->redirect(['login']);
            }
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionEditarTipoMonumento($id)
    {
        $model = new Tipomonumento();

        if ($model->load(Yii::$app->request->post())) {

            $tipoMonumentoVerifica = Tipomonumento::findOne(['descricao' => $model->descricao]);

            if ($tipoMonumentoVerifica == null) {
                $model->save();
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            } else {
                Yii::$app->session->setFlash('error', 'Tipo monumento já registado!');
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
            $tipoMonumentoVerifica = Tipomonumento::findOne(['descricao' => $model->descricao]);
            if ($tipoMonumentoVerifica == null) {
                $model->save();
                return $this->redirect(['pontosturisticos/create']);
            } else {
                Yii::$app->session->setFlash('error', 'Tipo monumento já registado!');
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

            $estiloConstrucaoVerifica = Estiloconstrucao::findOne(['descricao' => $model->descricao]);
            if ($estiloConstrucaoVerifica == null) {
                $model->save();
                return $this->redirect(['pontosturisticos/create']);
            } else {
                Yii::$app->session->setFlash('error', 'Estilo de Construção já registado!');
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
            $estiloConstrucaoVerifica = Estiloconstrucao::findOne(['descricao' => $model->descricao]);
            if ($estiloConstrucaoVerifica == null) {
                $model->save();
                return $this->redirect(['pontosturisticos/create']);
            } else {
                Yii::$app->session->setFlash('error', 'Estilo de Construção já registado!');
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
        $modelUpload = new UploadFormPontosTuristicos();

        if ($model->load(Yii::$app->request->post())) {
            $modelUpload->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->foto = UploadedFile::getInstance($modelUpload, 'imageFile')->name;
            $modelUpload->upload();
            $localidadeVerifica = Localidade::findOne(['nomeLocalidade' => $model->nomeLocalidade]);
            if ($localidadeVerifica == null) {
                $model->save();
                return $this->redirect(['pontosturisticos/create']);
            } else {
                Yii::$app->session->setFlash('error', 'Localidade já registada!');
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
            $localidadeVerifica = Localidade::findOne(['nomeLocalidade' => $model->nomeLocalidade]);
            if ($localidadeVerifica == null) {
                $model->save();
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            } else {
                Yii::$app->session->setFlash('error', 'Localidade já registada!');
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            }
        }
        return $this->render('registar-localidade', [
            'model' => $model,
        ]);
    }


}
