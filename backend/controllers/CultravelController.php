<?php

namespace backend\controllers;



use app\models\Estiloconstrucao;
use app\models\Localidade;
use app\models\Tipomonumento;
use app\models\UserSearch;
use common\models\LoginForm;
use Yii;
use yii\debug\models\search\User;
use yii\helpers\VarDumper;

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

    public function actionRegistarTipoMonumento($id)
    {
        $model = new Tipomonumento();

        if ($model->load(Yii::$app->request->post())) {
            $tipoMonumentoVerifica = Tipomonumento::findOne(['descricao'=>$model->descricao]);
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

    public function actionRegistarEstiloConstrucao($id)
    {
        $model = new Estiloconstrucao();

        if ($model->load(Yii::$app->request->post())) {
            $estiloConstrucaoVerifica = Estiloconstrucao::findOne(['descricao'=>$model->descricao]);
            if ($estiloConstrucaoVerifica == null){
                $model->save();
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            }
            else{
                Yii::$app->session->setFlash('error','Estilo de Construção já registado!');
                return $this->redirect(['pontosturisticos/update', 'id' => $id]);
            }
        }
        return $this->render('registar-estilo-construcao', [
            'model' => $model,
        ]);
    }

    public function actionRegistarLocalidade($id)
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
