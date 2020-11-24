<?php

namespace backend\controllers;



use app\models\UserSearch;
use common\models\LoginForm;
use Yii;
use yii\debug\models\search\User;

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

    public function actionPontosTuristicos()
    {
        return $this->render('gerir-pontos-turisticos');
    }

    public function actionGerirUtilizadores()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('gerir-utilizadores', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMensagens()
    {
        return $this->render('mensagens');
    }

}
