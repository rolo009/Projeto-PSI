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
        } else {
            return $this->redirect(['logout']);
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
            $user = User::find()->where(['email' => $model->email])->andWhere(['status' => 10])->one();
            if ($user != null) {

                if (Yii::$app->authManager->checkAccess($user->id, 'admin') == true || Yii::$app->authManager->checkAccess($user->id, 'moderador') == true) {
                    $model->login();
                    $this->layout = 'main';

                    return $this->render('index');
                }
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public
    function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
